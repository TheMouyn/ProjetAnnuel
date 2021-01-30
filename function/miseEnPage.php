<?php
function enDate($date):string{
   return (date('d/m/Y', strtotime($date)));
}