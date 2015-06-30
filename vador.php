<?php
$chaine=$HTTP_GET_VARS["chaine"];
if(strlen($chaine)>70){
        $linesize=array(27,28,28,28,28,27,20);
        $nline=7;
        $font=2;
        $incry=10;
}
else
{
        $linesize=array(19,20,19,12);
        $nline=4;
        $font=5;
        $incry=20;
}
$strtab=explode(" ",$chaine);

$l=0;
$i=0;
while(($i<count($strtab)) && ($l<$nline)){
        if(strlen($strtab[$i])>$linesize[$l]){
                $finalstrtab[$l]=substr($strtab[$i],0,$linesize[$l]);
                $l++;
                $strtab[$i]=substr($strtab[$i],$linesize[$l]+1);
        }else{
                if((strlen($finalstrtab[$l])+strlen($strtab[$i])+1)>$linesize[$l])
                        $l++;
                else{
                        $finalstrtab[$l]=$finalstrtab[$l] . " " . $strtab[$i];
                        $i++;
                }
        }
}

$vader=imagecreatefromgif("vador.gif");
$black = imagecolorallocate($vader, 0, 0, 0);

$y=20;
for($i=0;$i<$nline;$i++){
        imagestring($vader,$font,160,$y,stripslashes($finalstrtab[$i]),$black);
        $y=$y+$incry;
}

header("Content-Type: image/gif");
imagegif($vader);
?>