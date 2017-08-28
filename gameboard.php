<?php
date_default_timezone_set('America/Los_Angeles');
// date_default_timezone_set('America/Chicago');
include "include/header.php";
include "include/selector.php";
include "include/hostname.php";
include "include/delete.php";
 ?>
 <input type="hidden" value="<?= $hostname?>" id="hostname">
 <div class="top">
    <?php if(isset($_SESSION['uid'])){ ?>
    <a class="button is-large" id="open">Start a Game</a>
    <?php } ?>
</div>
<main<?php if(!isset($_SESSION['uid'])){?> class="mar-top" <?php }?>>

    <div class="box box-style box-height" id="gameBox">

     <div class="container"><div class="loader"></div> </div>
    </div>
    <div class="map-holder box box-style overflow box-height">
        <div class="box" id="map"></div>
        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
        <button type="button" class="button is-primary" id="locationSave">Save</button>
    </div>

</main>


<div class="modal-back" id="modal">
    <div class="box modal-box" id="formBox">
        <form action="include/addgame.php" method="post" id="add-form">
            <h3 class="title">Create a Game</h3>

            <div class="form-contain">
                <div class="split">
                    <div class="form-col">
                        <div class="datetime">
                            <p>Date</p>
                            <div class="row">
                            <div class="select is-small">
                                <select name="month" class="form-field" id="month">
                                    <option disabled="disabled" selected="selected">Month</option>
                                    <option value="1" <?= $jan?>>Jan</option>
                                    <option value="2" <?= $feb?>>Feb</option>
                                    <option value="3" <?= $mar?>>Mar</option>
                                    <option value="4" <?= $apr?>>Apr</option>
                                    <option value="5" <?= $may?>>May</option>
                                    <option value="6" <?= $jun?>>June</option>
                                    <option value="7" <?= $jul?>>July</option>
                                    <option value="8" <?= $aug?>>Aug</option>
                                    <option value="9" <?= $sep?>>Sept</option>
                                    <option value="10" <?= $oct?>>Oct</option>
                                    <option value="11" <?= $nov?>>Nov</option>
                                    <option value="12" <?= $dec?>>Dec</option>
                                </select>
                            </div>
                            <div class="select is-small">
                                <select name="day" class="form-field" id="day">
                                    <option  disabled="disabled" selected="selected">Day</option>
                                    <option value="1" <?= $s1?>>1</option>
                                    <option value="2" <?= $s2?>>2</option>
                                    <option value="3" <?= $s3?>>3</option>
                                    <option value="4" <?= $s4?>>4</option>
                                    <option value="5" <?= $s5?>>5</option>
                                    <option value="6" <?= $s6?>>6</option>
                                    <option value="7" <?= $s7?>>7</option>
                                    <option value="8" <?= $s8?>>8</option>
                                    <option value="9" <?= $s9?>>9</option>
                                    <option value="10" <?= $s10?>>10</option>
                                    <option value="11" <?= $s11?>>11</option>
                                    <option value="12" <?= $s13?>>12</option>
                                    <option value="13" <?= $s13?>>13</option>
                                    <option value="14" <?= $s14?>>14</option>
                                    <option value="15" <?= $s15?>>15</option>
                                    <option value="16" <?= $s16?>>16</option>
                                    <option value="17" <?= $s17?>>17</option>
                                    <option value="18" <?= $s18?>>18</option>
                                    <option value="19" <?= $s19?>>19</option>
                                    <option value="20" <?= $s20?>>20</option>
                                    <option value="21" <?= $s21?>>21</option>
                                    <option value="22" <?= $s22?>>22</option>
                                    <option value="23" <?= $s23?>>23</option>
                                    <option value="24" <?= $s24?>>24</option>
                                    <option value="25" <?= $s25?>>25</option>
                                    <option value="26" <?= $s26?>>26</option>
                                    <option value="27" <?= $s27?>>27</option>
                                    <option value="28" <?= $s28?>>28</option>
                                    <option value="29" <?= $s29?>>29</option>
                                    <option value="30" <?= $s30?>>30</option>
                                    <option value="31" <?= $s31?>>31</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="datetime">
                            <p>Time</p>
                            <div class="row">
                            <div class="select is-small">
                                <select name="hour" class="form-field" id="hour">
                                    <option value="12"  selected="selected">12</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                </select>
                            </div>
                            :
                            <div class="select is-small">
                                <select name="minute" class="form-field" id="minute">
                                    <option value="00" selected="selected">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>
                            <div class="select is-small">
                                <select name="ampm" id="ampm">
                                    <option value="am">AM</option>
                                    <option value="pm" selected="selected">PM</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="split">
                    <div class="form-col radio-col">
                        <p id="genderTitle">Gender</p>
                        <div class="radio-option">
                            <input type="radio" name="gender" value="m" class="form-field" >
                            <span>Male</span>
                        </div><br>
                        <div class="radio-option">
                            <input type="radio" name="gender" value="f" >
                            <span>Female</span>
                        </div><br>
                        <div class="radio-option">
                            <input type="radio" name="gender" value="c" >
                            <span class="last">Co-Ed</span>
                        </div>
                    </div>
                    <div class="form-col radio-col">
                        <p id="intensityTitle">Intensity</p>
                        <div class="radio-option-intensity">
                            <input class="radio" type="radio" name="level" value="1" class="form-field" >
                            <span>Recreational</span>
                        </div><br>
                        <div class="radio-option-intensity">
                            <input class="radio" type="radio" name="level" value="2" >
                            <span>Competitive</span>
                        </div>
                    </div>
                </div>
                <div class="split">
                    <div class="form-col stretch">
                        <p id="locationTitle">Location</p>
                        <button class="button is-small  is-primary stretch" type="button" id="locationBtn">Find location</button>
                        <input type="hidden" name="lat" id="lat" class="form-field" >
                        <input type="hidden" name="lng" id="lng" class="form-field" >
                        <input type="hidden" name="address" id="address" class="form-field">
                    </div>
                    <div class="form-col stretch">
                        <p id="openingsTitle">Number of Players</p>
                        <input class="input is-small form-field" type="number" name="size" value="" id="size">
                    </div>
                </div>
                <div class="split">
                    <div class="form-col stretch">
                        <p id="colorsTitle">Shirt Colors</p>
                        <div class="color-row">
                            <input class="input is-small form-field  shirt-colors" type="text" name="colors" placeholder="Shirt color #1" id="color1">
                            <input class="input is-small form-field  shirt-colors" type="text" name="colors2" placeholder="Shirt color #2" id="color2">
                        </div>

                    </div>
                    <div class="form-col stretch">
                        <p>Misc. Details</p>
                        <textarea name="details" rows="1" class="textarea is-small" id="details"></textarea>
                    </div>
                </div>
            </div>

            <span id="fieldsCheck">*Please fill out all fields!</span>
            <div class="btn-row">
                <button class="button is-primary" id="submit" type="submit" name="submit" >submit</button>
                <button class="button" id="cancel" type="reset">cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="results"></div>

<script type="text/javascript" src="js/location.js"></script>
<script type="text/javascript" src="js/gameboard.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsBiIrBz4y8tB8DGwqzIIta1TyEW90Xcw&libraries=places&callback=initAutocomplete" -->
     async defer></script>
 <?php
include "include/footer.php"
  ?>
