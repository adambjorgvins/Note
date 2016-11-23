<?php
session_start();
if(!isset($_SESSION['username'])){
    $_SESSION['returnUrl'] = '/clock';
    header("Location: ../login");
}

require("php/config.php");
?>

<h1 class="blue-grey-text text-lighten-2 center">Clock</h1>

<div class="container">
    <div class="row">
        <div class="col s12 m7">
            <button class="btn lighten-2 btn-large col s12" id="in"></button>
        </div><div class="col s12 m5">
            <div class="card blue-grey lighten-2">
                <div class="card-content white-text">
                    <h1 class="center" id="clock">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </h1>
                </div>
            </div>
        </div>
        <blockquote class="col">
            You are now clocked <b id="inORout"></b>.<br>
            You last clocked in at <b id="clockInTime">00:00</b>.
        </blockquote>
    </div>
    <div class="row">
        <div class="allTime">
            <table class="striped centered responsive-table">
                <thead>
                <tr>
                    <th data-field="in">In</th>
                    <th data-field="out">Out</th>
                    <th data-field="total">Total</th>
                </tr>
                </thead>
                <tbody id="tableContent">
                </tbody>
            </table>
        </div>
    </div>
</div>

