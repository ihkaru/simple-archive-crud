<?php
function cons($key,$default = null){
    return config("constants.".$key,$default);
}
