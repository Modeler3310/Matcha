<form class="form-horizontal" method="post" action="">
    <div class="form-group">
        
        <br>
        <h5>Localisation:</h5>
        <div class="range-slider">
            <input class="range-slider__range" type="range" value="500" min="5" max="5000">
            <span id='val_distance' class="range-slider__value">500</span>
        </div>
        <br>
        <div class="container ">
            <h5>Age</h5><br>
            <div class="row ">
                <div class="col-3">
                    <p>from:</p>
                </div>
                <div class="col-2">
                    <div class="range-slider">
                        <input class="range-slider__range" type="range" value="18" min="18" max="100" style="transform: rotate(-90deg); width: 60px;">
                        <span id='val_ageLow' class="range-slider__value mt-3">18</span>
                    </div>
                </div>
                <div class="col-4">
                <p>to:</p>
                </div>
                <div class="col-2">
                    <div class="range-slider">
                        <input class="range-slider__range" type="range" value="99" min="18" max="99"  style="transform: rotate(-90deg); width: 60px;">
                        <span id='val_ageHigh' class="range-slider__value mt-3">99</span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h5>Score de Popularite >=</h5>
        <div class="range-slider ">
            <input class="range-slider__range" type="range" value="0" min="0" max="100">
            <span id='val_pop_score' class="range-slider__value">0</span>
        </div>

    <br>
    
        <button id='filter' class="btn btn-outline-success btn-block" name="search">Search</button>
    </div>
</div>
</form>