<?php
if(!class_exists("InputException")){
        
    class InputException extends Exception{
    }
}    

if(!class_exists("AttrException")){
        
    class AttrException extends Exception{
    }
}
    
if(!class_exists("ExceptionHandlerclass")){
    class ExceptionHandlerclass{
        public $info;
        public $details;
        function SetException($info,$details){
            $this->info =  $info;
            $this->details = $details;
        }
    }
}
?>