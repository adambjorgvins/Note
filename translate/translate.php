<?php
session_start();
if(!isset($_SESSION['username'])){
    $_SESSION['returnUrl'] = '/translate';
    header("Location: ../login");
}
?>

<div id="slikja"></div>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Delete a translation?</h4>
        <p>Are You sure you want to delete</p>
    </div>
    <div class="modal-footer">
        <a href="#!" id="agree" class=" modal-action modal-close waves-effect waves-green btn-flat">YES</a>
        <a href="#!" id="disagree" class=" modal-action modal-close waves-effect waves-green btn-flat">NO</a>
    </div>
</div>
<div class="form">
    <i class="large material-print"></i>


    <div class="row">
        <div class="col s4 hide-on-small-only"></div>
        <div style="color: #26a69a" class="center-align col s12 m4"><h1>Glossary</h1></div>
        <div class="col s12 m4">
            <div style="width: 333px" class="center-align input-field">
                <i class="material-icons prefix">search</i>
                <input id="searchGlossary" type="text" class="validate">
                <label for="icon_prefix" class="left-align">Search for glossary</label>
            </div>
        </div>
    </div>






    <div class="container">
        <div class="row">
            <input tabindex="1" class="autocomplete center col s3 autocomplete-input" id="category" name="category" placeholder="Make a category" type="text">
            <ul class="autocomplete-content dropdown-content"></ul><ul class="autocomplete-content dropdown-content"></ul>
            <button class="addbutton  offset-s1 col s3 large material-icons btn waves-effect waves-light bold center" id="addToNote" type="submit">save</button>
            <button class="savebutton offset-s1 col s3 large material-icons btn waves-effect waves-light bold center" id="btn" onclick="window.print();" value="Print">print</button>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div>
                <textarea class="materialize-textarea col s5 validate" id="input" tabindex="2"  placeholder="translate"></textarea></div>
                <div      class="center col s2 summa">=</div><div>
                <textarea class="materialize-textarea col s5 validate to" tabindex="3"  id="to"></textarea></div>
                <div      class="input-field col s5" id="asdfg"></div> 
                <button   class="col s2 large material-icons btn waves-effect waves-light switch-button" id="swap-butt" style="font-size: 20px">swap_horiz</button>
                <div      class="input-field col s5" id="asdf"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div id="render"></div>
    </div>
</div>
