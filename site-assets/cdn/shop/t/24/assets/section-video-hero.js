if (!customElements.get("hero-video")) {
  class HeroVideo extends HTMLElement {
    constructor() {
      super();
      this.videoPlaying = true;
      this.playButton = document.querySelector("[data-video-play-button]");
      this.videoWrapper = this.querySelector("[data-video-wrapper]");
      this.video = this.videoWrapper ? this.videoWrapper.querySelector("video") : null;
      this.placeholder = this.querySelector("[data-video-placeholder-image]");

      if (this.playButton) {
        this.playButton.addEventListener("click", this.toggleVideo.bind(this));
      }

      if (this.video) {
        this.initVideo();
      }
    }

    initVideo() {
      const updateSource = () => {
        const source = this.video.querySelector("source") || this.video.firstChild;
        if (source) {
          const currentSrc = window.innerWidth < 768 
            ? (source.getAttribute("data-mobile-src") || source.getAttribute("src"))
            : (source.getAttribute("data-desktop-src") || source.getAttribute("src"));
          if (currentSrc && source.getAttribute("src") !== currentSrc) {
            source.setAttribute("src", currentSrc);
            this.video.load();
          }
        }
      };

      updateSource();

      const startPlay = () => {
        const promise = this.video.play();
        if (promise !== undefined) {
          promise.then(() => {
            this.videoPlaying = true;
            if (this.placeholder) this.placeholder.classList.add("d-none");
            if (this.videoWrapper) this.videoWrapper.classList.remove("d-none");
            this.updateButtonIcons();
          }).catch(() => {
            // Autoplay blocked by browser policy until interaction
          });
        }
      };

      if (this.video.readyState >= 2) {
        startPlay();
      } else {
        this.video.addEventListener("canplay", startPlay, { once: true });
        this.video.addEventListener("loadeddata", startPlay, { once: true });
      }

      this.video.addEventListener("play", () => {
        this.videoPlaying = true;
        this.updateButtonIcons();
      });

      this.video.addEventListener("pause", () => {
        this.videoPlaying = false;
        this.updateButtonIcons();
      });
    }

    updateButtonIcons() {
      if (!this.playButton) return;
      const pauseIcon = this.playButton.querySelector(".pause-icon");
      const playIcon = this.playButton.querySelector(".play-icon");
      if (this.videoPlaying) {
        if (pauseIcon) {
          pauseIcon.classList.remove("d-none");
          pauseIcon.style.display = "flex";
        }
        if (playIcon) {
          playIcon.classList.add("d-none");
          playIcon.style.display = "none";
        }
      } else {
        if (pauseIcon) {
          pauseIcon.classList.add("d-none");
          pauseIcon.style.display = "none";
        }
        if (playIcon) {
          playIcon.classList.remove("d-none");
          playIcon.style.display = "flex";
        }
      }
    }

    playVideo() {
      if (this.placeholder) this.placeholder.classList.add("d-none");
      if (this.videoWrapper) this.videoWrapper.classList.remove("d-none");
      if (this.video) {
        this.video.play().then(() => {
          this.videoPlaying = true;
          this.updateButtonIcons();
        }).catch(() => {});
      }
    }

    pauseVideo() {
      if (this.video) {
        this.video.pause();
        this.videoPlaying = false;
        this.updateButtonIcons();
      }
    }

    toggleVideo() {
      if (!this.video) return;
      if (this.video.paused) {
        this.playVideo();
      } else {
        this.pauseVideo();
      }
    }
  }

  customElements.define("hero-video", HeroVideo);
}


