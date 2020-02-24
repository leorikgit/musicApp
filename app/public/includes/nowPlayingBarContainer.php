<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <span class="albumLink">
                <img src="https://i.pinimg.com/originals/27/56/e6/2756e6e14a8206f3a702558bec753661.jpg" class="albumArtwork">
            </span>
            <div class="trackInfo">
                <span class="artistName">Artist Name</span>
                <span class="">Song Title</span>
            </div>

        </div>

        <div id="nowPlayingCenter">
            <div class="content playerControls">

                <div class="Buttons">
                    <button class="controlButton shuffle" title="Shuffle">
                        <img src="<?php echo "/assets/images/icons/shuffle.png"?>">
                    </button>
                    <button class="controlButton previous" title="Previous">
                        <img src="<?php echo "/assets/images/icons/previous.png"?>">
                    </button>
                    <button class="controlButton play" title="Play">
                        <img src="<?php echo "/assets/images/icons/play.png"?>">
                    </button>
                    <button class="controlButton pause" title="Pause" style="display: none">
                        <img src="<?php echo "/assets/images/icons/pause.png"?>">
                    </button>
                    <button class="controlButton next" title="Next">
                        <img src="<?php echo "/assets/images/icons/next.png"?>">
                    </button>
                    <button class="controlButton repeat" title="Repeat">
                        <img src="<?php echo "/assets/images/icons/repeat.png"?>">
                    </button>
                </div>
                <div id="playbackBar">
                    <div class="progressTime currentTime">0.00</div>
                    <div class="progressBar">
                        <div class="progressBarBG">
                            <div id="progress"></div>
                        </div>
                    </div>
                    <div class="progressTime remainingTime">0.00</div>
                </div>
            </div>
        </div>

        <div id="nowPlayingRight">
            <div id="volumeBar">
                <button class="controlButton volume" title="Volume">
                    <img src="<?php echo "/assets/images/icons/volume.png"?>">
                </button>
                <div class="progressBar">
                    <div class="progressBarBG">
                        <div id="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>