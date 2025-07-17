<div x-data="{ open: false }">
	<button class="btn" x-on:click="open = true"><i class="fas fa-plus-circle"></i>Add File</button>
	<div class="modal" x-show="open" x-transition.opacity x-cloak>
		<div class="modal__container">
			<form
				wire:submit.prevent="store"
				x-data="{
					link: $wire.entangle('link').live,
					tab: 'upload',
					showPreview: false,
					embedHTML: '',
					updateEmbed() {
						const val = this.link.trim();
						this.showPreview = false;

						const igMatch = val.match(/instagram\.com\/(?:[^\/]+\/)?(reel|p)\/([a-zA-Z0-9_-]+)/);
                        if (igMatch) {
                            const type = igMatch[1];
                            const id = igMatch[2];
                            this.link = `https://www.instagram.com/${type}/${id}/`;
                            this.embedHTML = `<blockquote class='instagram-media' data-instgrm-permalink='${this.link}' data-instgrm-version='14' style='width:100%; min-height:400px;'></blockquote>`;
                            this.showPreview = true;
                            this.$nextTick(() => window.instgrm?.Embeds.process());
                            return;
                        }


						if (/(youtu\.be\/|youtube\.com\/(watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]+)/.test(val)) {
							const id = val.match(/(?:youtu\.be\/|watch\?v=|embed\/|shorts\/)([a-zA-Z0-9_-]+)/)[1];
							this.link = `https://www.youtube.com/embed/${id}`;
							this.embedHTML = `<iframe src='${this.link}' width='100%' height='315' frameborder='0' allowfullscreen></iframe>`;
							this.showPreview = true;
							return;
						}

						if (/tiktok\.com\/(@[\w.-]+)\/video\/(\d+)/.test(val)) {
                            const [_, user, id] = val.match(/tiktok\.com\/(@[\w.-]+)\/video\/(\d+)/);
                            this.link = `https://www.tiktok.com/${user}/video/${id}`;
                            this.embedHTML = `<blockquote class='tiktok-embed' cite='${this.link}' data-video-id='${id}' style='width:100%; min-height:400px;'><section>Loading TikTok...</section></blockquote>`;
                            this.showPreview = true;
                            this.$nextTick(() => {
                                if (window.tiktok?.load) {
                                    window.tiktok.load();
                                }
                            });
                            return;
                        }

						this.embedHTML = '';
					}
				}"
				x-init="$watch('link', value => updateEmbed())"
			>
				<div class="form__tab">
					<span :class="{ 'active': tab === 'upload' }" @click="tab = 'upload'; link = ''; showPreview = false; embedHTML = '';">Upload</span>
					<span :class="{ 'active': tab === 'link' }" @click="tab = 'link'; $wire.set('file', null);">Link</span>
				</div>
				<div class="form__input">
					<button type="button" class="btn btn-outline" x-show="tab === 'upload'" @click="$refs.fileInput.click()">Browse File</button>
					<input type="file" wire:model="file" accept="image/*,video/*,audio/*" x-show="tab === 'upload'" x-ref="fileInput" hidden>
					<div x-show="tab === 'link'" class="mt-4">
						<label>
							<input type="text" wire:model.live="link" placeholder="Paste link here (Instagram, YouTube, TikTok)..." x-model="link">
						</label>
					</div>
				</div>
				<div class="form__preview">
					<div class="preview__container">
						@if ($file)
							<div class="preview__result">
								@php $mime = $file->getMimeType(); @endphp
								@if (str_starts_with($mime, 'image/'))
									<img src="{{ $file->temporaryUrl() }}" alt="Preview" class="w-64 h-auto">
								@elseif (str_starts_with($mime, 'video/'))
									<video controls class="w-64 h-auto">
										<source src="{{ $file->temporaryUrl() }}" type="{{ $mime }}">
									</video>
								@elseif (str_starts_with($mime, 'audio/'))
									<audio controls class="w-64">
										<source src="{{ $file->temporaryUrl() }}" type="{{ $mime }}">
									</audio>
								@else
									<p>File type not supported for preview.</p>
								@endif
							</div>
						@else
							<div x-if="showPreview" class="preview__result" x-html="embedHTML"></div>
							<div x-show="!showPreview" class="preview__placeholder">
								<img class="icon" src="{{ asset('assets/img/media-icon.png') }}" alt="">
								<small x-text="tab === 'upload' ? 'Browse or Drop File Here' : 'Paste a link above'"></small>
							</div>
						@endif
					</div>
				</div>
				<div class="buttons mt-4">
					<button class="btn btn-outline" type="button" x-on:click="open = false">Cancel</button>
					<button class="btn" type="submit">Add</button>
				</div>
			</form>
		</div>
	</div>
	<script async src="https://www.instagram.com/embed.js"></script>
	<script async src="https://www.tiktok.com/embed.js"></script>
</div>
