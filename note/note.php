
<?php
session_start();
if(!isset($_SESSION['username'])){
    $_SESSION['returnUrl'] = '/note';
    header("Location: ../login");
}
?>
<div class="container">
    <div class="row">
        <div class="col s12 m6 l4">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="title">
                    <textarea id="addNote" class="materialize-textarea"></textarea>
                    <label for="addNote">Take a note...</label>
                    <button id="submitnote" class="btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="render"></div>
<script>
    $('#addNote').trigger('autoresize');
</script>
