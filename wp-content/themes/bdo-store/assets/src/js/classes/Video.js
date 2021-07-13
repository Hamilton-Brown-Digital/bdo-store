class Video {

  constructor() {
    this.tag = document.createElement('script');
    this.player = '';
    this.playeriFrame = document.querySelector('.js-video')
    this.placeholder = document.querySelector('.js-video-placeholder')
  }

  /* eslint-disable */
  init() {
    this.tag.src = "//www.youtube.com/player_api";
    let firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(this.tag, firstScriptTag);
  }

  initYoutube () {
    if ( this.playeriFrame ) {
      this.player = new YT.Player(this.playeriFrame, {
          events: {
              'onReady': () => {
                  this.onPlayerReady( this )
              },
              'onStateChange': ( ev ) => {
                  this.onPlayerStateChange( ev, this )
              }
          }
      })
    }
  }

  onPlayerReady( self ) {
    self.placeholder.addEventListener('click', () => {
        self.player.playVideo()
    })
}

  onPlayerStateChange( ev, self ) {
    if ( ev.data == 1 ) {
        self.placeholder.classList.add('hide')
    } else {
        self.placeholder.classList.remove('hide')
    }
  }
  /* eslint-enable */
}

export default Video
