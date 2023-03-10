<div class="driver-cards">
    <div class="flip-card driver-cards" style="--team-color: #443ff3">    
        <div class="flip-card-inner">    
            <div class="driver-card card-background">
                <!-- <div class="helmet-image-layer"><img src="https://mark-boots.nl/codepenfiles/f1/img/drivers/ver_helmet.png"></div> -->
                <div class="driver-image-layer"><img src="https://mark-boots.nl/codepenfiles/f1/img/drivers/ver.png"></div>
                <div class="overlay">
                    <div class="number">01</div>
                    <!-- <div class="abbr">TAL</div> -->
                    <img class="flag" src="{{ Storage::url('/img/f1/flags/brazil.png' ) }}">
                    <img class="team" src="{{ Storage::url('/img/f1/logo/redbull_logo.png' ) }}">
                </div>
                <div class="overlay-name">
                <!-- <div class="first-name">Max</div> -->
                    <div class="last-name">Talitinha</div>
                    <div class="bio-wrap">
                        <div>Equipe:</div>    
                        <div>Red Bull Racing Honda</div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="details-card">    
            <div class="card-background"></div>    
            <div class="details-inner">    
                <div class="detail-name">Max
                    <br>Verstappen
                    </div><img class="detail-helmet" src="https://mark-boots.nl/codepenfiles/f1/img/drivers/ver_helmet.png"><img class="detail-number" src="https://mark-boots.nl/codepenfiles/f1/img/drivers/ver_nr.png"><img class="detail-car" src="https://mark-boots.nl/codepenfiles/f1/img/teams/redbull_car.png">
                        <div class="bio-wrap">    
                            <div>Country:</div>    
                            <div>Netherlands</div>    
                            <div>Dob:</div>
                            <div>29/09/1997 <span>(24)</span></div>
                            <div>Team:</div>    
                            <div>Red Bull Racing Honda</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>    

@push('css')

<style>

@import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;700&display=swap");
:root {
  --font-bold-narrow: "Staatliches", sans-serif;
  /* --font-normal-narrow: "Roboto Condensed", "sans-serif"; */
  --font-normal-narrow: "Roboto Condensed", sans-serif;
  font-size: 20px;
}

/* *,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box; */

.driver-cards {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  justify-content: center;
}

.flip-card {
  background-color: transparent;
  width: 15rem;
  height: 20rem;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  transition: transform 0.8s;
  transform-style: preserve-3d;
  cursor: pointer;
  user-select: none;
}
.flip-card.active .flip-card-inner {
  transform: rotateY(180deg);
}
.driver-card,
.details-card {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
  border-radius: 1em;
  overflow: hidden;
}
/* front card */
.driver-card {
  background: black;
  position: relative;
  filter: drop-shadow(0 0 0.5rem var(--team-color));
}

.driver-card .helmet-image-layer {
  position: absolute;
  justify-content: center;
  align-items: center;
  display: flex;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  mix-blend-mode: multiply;
  opacity: 0.2;
}
.driver-card .helmet-image-layer img {
  filter: grayscale(1);
}

.driver-card .driver-image-layer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}
.driver-card .driver-image-layer img {
  height: 100%;
  right: -5rem;
  filter: drop-shadow(-0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.5));
  transition: transform 0.25s ease;
  transform-origin: bottom right;
  transform: scale(0.95);
}
.flip-card:hover .driver-image-layer img {
  height: 100%;
  transform-origin: bottom right;
  transform: scale(1);
}

.driver-card .driver-image-layer:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  box-shadow: inset 0 0 1.5rem 0.5rem rgba(0, 0, 0, 0.8);
}

.driver-card .overlay {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  padding: 1rem;
  align-items: center;
  color: white;
  z-index: 1;
}
.driver-card .overlay .number {
  font-size: 2rem;
  line-height: 2rem;
  text-shadow: 0 0 0.2rem black;
}
.driver-card .overlay .abbr {
  font-size: 1.2rem;
  line-height: 1.2rem;
  margin-bottom: 0.5rem;
  text-shadow: 0 0 0.2rem black;
}
.driver-card .overlay .flag,
.driver-card .overlay .team {
  margin-top: 0.5rem;
  width: 1.5rem;
  height: 1.5rem;
  border-radius: 50%;
  object-fit: contain;
  background-color: white;
  padding: 0.05rem;
  box-shadow: 0 0 0.2rem rgba(0, 0, 0, 0.5);
}

.driver-card .overlay-name {
  position: absolute;
  /* display: flex; */
  flex-direction: column;
  padding: 1rem;
  color: white;
  font-family: var(--font-bold-narrow);
  z-index: 1;
  text-shadow: 0 0 0.2rem black, 0 0 0.2rem black, 0 0 0.2rem var(--team-color),
    0 0 0.2rem var(--team-color);
  bottom: 0;
}
.driver-card .overlay-name img.helmet {
  height: 3rem;
  margin-left: -1rem;
}
.driver-card .overlay-name .first-name {
  font-size: 1rem;
  line-height: 1rem;
}
.driver-card .overlay-name .last-name {
  font-size: 2rem;
  line-height: 2rem;
}

.card-background:after {
  content: "";
  position: absolute;
  width: 400%;
  height: 100%;
  transform: skew(-22.5deg) translateX(-25%);
  transform-origin: top left;
  background-color: var(--team-color);
  background-image: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0.05) 50%,
      transparent 50%
    ),
    linear-gradient(90deg, rgba(0, 0, 0, 0.08) 50%, transparent 50%),
    linear-gradient(90deg, transparent 50%, rgba(0, 0, 0, 0.11) 50%),
    linear-gradient(90deg, transparent 50%, rgba(0, 0, 0, 0.14) 50%);
  background-size: 15%, 28%, 35%, 50%;
  margin: 0;
  transition: transform 0.25s ease;
}
.driver-card.card-background:hover:after {
  transform: skew(-22.5deg) translateX(-15%);
}

.details-card {
  /* background-color: dodgerblue; */
  display: flex;
  color: white;
  transform: rotateY(180deg);
  width: 100%;
  height: 100%;
}

.details-card .details-inner {
  box-shadow: inset 0 0 1.5rem 0.5rem rgba(0, 0, 0, 0.8);
  display: flex;
  flex-wrap: wrap;
  color: white;
  width: 100%;
  height: 100%;
  z-index: 1;
  padding: 1rem;
  font-size: 1.5rem;
  line-height: 1.5rem;
  text-shadow: 0 0 0.2rem black;
  gap: 0.5em;
}

.details-inner > * {
  position: absolute;
}
.detail-name {
  top: 1rem;
  left: 1rem;
}
.detail-helmet {
  bottom: 1.1rem;
  right: 0.8rem;
  height: 2.4rem;
  width: 2.8rem;
  object-fit: cover;
  object-position: 50% 50%;
}
.detail-number {
  top: 1rem;
  right: 1rem;
  height: 3rem;
  width: 3rem;
  object-fit: contain;
  background-color: white;
  border-radius: 50%;
  box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.5);
}
.detail-car {
  bottom: 1rem;
  left: -100%;
  height: 3rem;
  transition: left 0.8s ease;
}
.active .detail-car {
  left: 1rem;
}

.bio-wrap {
  top: 5rem;
  display: grid;
  font-size: 1rem;
  line-height: 1rem;
  grid-template-columns: min-content auto;
  gap: 0.2rem 0.5rem;
  font-family: var(--font-normal-narrow);
  font-weight: 400;
  padding-right: 1rem;
  /* white-space: nowrap; */
}
.bio-wrap > *:nth-child(even) {
  font-weight: 700;
}
.bio-wrap span {
  font-weight: 300;
}
</style>


@endpush('css')