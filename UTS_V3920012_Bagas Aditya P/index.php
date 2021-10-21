<?php

include "convert.php";
 
?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <title></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 0.18" />
    <link rel="stylesheet"  type="text/css" href="index.css">
    <script type="text/javascript">
    function SelectAll(id){
        document.getElementById(id).focus();
        document.getElementById(id).select();
    }
    
    function InfoCaesar(){
        alert("Key hanya berupa kombinasi angka,"+'\n'+"dan plan text tidak boleh mengandung angka!");
    }
    function InfoVigenere(){
        alert("Key hanya berupa kombinasi kata, tidak boleh mengandung angka,"+'\n'+"dan plan text tidak boleh mengandung angka!");
    }
    </script>
</head>
 
<body>
    <center>
    <h2>Caesar Cipher dan Vigenere Cipher</h2>
    <h4><a onclick="Info()"></a></h4>
    </center>
    <table width="600" align="center">
    <tr><td width="50%" valign="top">
    <fieldset>
    <legend><b>Caesar</b></legend>
    <form action="" method="post">
    <input type="text" name="key_caesar" id="key_caesar" value="kunci..." onclick="SelectAll('key_caesar')" />
    <input type="submit" value="?" onclick="InfoCaesar()" /><br/>
    <textarea rows="4" name="plantext_caesar" id="plantext_caesar" cols="33" onclick="SelectAll('plantext_caesar')" >plan text...</textarea><br/>
    <input type="submit" name="encrypt_caesar" value="Enkripsi" /><input type="submit" name="decrypt_caesar" value="Dekripsi" /><input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td><td valign="top" colspan="3">
    <fieldset>
    <legend><b>Hasil</b></legend>
    <?php
    //----------------------------------------------------------------//
    // caesar                                                         //
    //----------------------------------------------------------------//
        if((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['encrypt_caesar'])){
            $key=$_POST['key_caesar'];
            $plantext=$_POST['plantext_caesar'];
            $split_key=str_split($key);
            $i=0;
            $split_chr=str_split($plantext);
            while ($key>52){
                $key=$key-52;
            }
            foreach($split_chr as $chr){
               if (char_to_dec($chr)!=null){
                    $split_nmbr[$i] = char_to_dec($chr);
                } else {
                    $split_nmbr[$i]=$chr;
                }
                $i++;
            }
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            foreach($split_nmbr as $nmbr){
                if (($nmbr+$key)>52){
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char(($nmbr+$key)-52);
                    } else {
                        echo $nmbr;
                    }
                } else {
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char($nmbr+$key);
                    } else {
                        echo $nmbr;
                    }
                }
            }
            echo '</textarea><br/>';
        } else if ((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['decrypt_caesar'])){
            $key=$_POST['key_caesar'];
            $plantext=$_POST['plantext_caesar'];
            $i=0;
            $split_chr=str_split($plantext);
            while ($key>52){
                $key=$key-52;
            }
            foreach($split_chr as $chr){
                if (char_to_dec($chr)!=null){
                    $split_nmbr[$i]=char_to_dec($chr);
                } else {
                    $split_nmbr[$i]=$chr;
                }
                $i++;
            }
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            foreach($split_nmbr as $nmbr){
                if (($nmbr-$key)<1){
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char(($nmbr-$key)+52);
                    } else {
                        echo $nmbr;
                    }
                } else {
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char($nmbr-$key);
                    } else {
                        echo $nmbr;
                    }
                }
            }
            echo '</textarea><br/>';
             
    //----------------------------------------------------------------//
    // vigenere                                                       //
    //----------------------------------------------------------------//
        } else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['encrypt_vigenere']))){
            $key=$_POST['key_vigenere'];
            $plantext=$_POST['plantext_vigenere'];
            $len_key=strlen($key);
            $len_plantext=strlen($plantext);
            $split_key=str_split($key);
            $split_plantext=str_split($plantext);
             
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            $i=0;
            for($j=0;$j<$len_plantext;$j++){
                if ($i==$len_key){
                    $i=0;
                }
                $split_key2[$j]=$split_key[$i];
                $i++;
            }
            for($k=0;$k<$len_plantext;$k++){
                $a=char_to_dec($split_key2[$k]);
                $b=char_to_dec($split_plantext[$k]);
                if (($a && $b)!=null){
                    echo (tabel_vigenere_encrypt($a, $b));
                } else {
                    echo $split_plantext[$k];
                }
            }
            echo '</textarea><br/>';
        } else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['decrypt_vigenere']))){
            $key=$_POST['key_vigenere'];
            $plantext=$_POST['plantext_vigenere'];
            $len_key=strlen($key);
            $len_plantext=strlen($plantext);
            $split_key=str_split($key);
            $split_plantext=str_split($plantext);
             
            echo '<textarea rows="4" id="result" cols="33" onclick="SelectAll(\'result\')" >';
            $i=0;
            for($j=0;$j<$len_plantext;$j++){
                if ($i==$len_key){
                    $i=0;
                }
                $split_key2[$j]=$split_key[$i];
                $i++;
            }
             
            for($k=0;$k<$len_plantext;$k++){
                $a=char_to_dec($split_key2[$k]);
                $b=char_to_dec($split_plantext[$k]);
                if (($a && $b)!=null){
                    echo (tabel_vigenere_decrypt($b, $a));
                } else {
                    echo $split_plantext[$k];
                }
            }
             
            echo '</textarea><br/>';
 
        } else {
            echo "result here...";
        }
    ?>
    </fieldset>
    </td></tr>
    <tr><td valign="top">
    <fieldset>
    <legend><b>Vigenere</b></legend>
    <form action="" method="post">
    <input type="text" name="key_vigenere" id="key_vigenere" value="kunci..." onclick="SelectAll('key_vigenere')" />
    <input type="submit" value="?" onclick="InfoVigenere()" /><br/>
    <textarea rows="4" name="plantext_vigenere" id="plantext_vigenere" cols="33" onclick="SelectAll('plantext_vigenere')" >plan text...</textarea><br/>
    <input type="submit" name="encrypt_vigenere" value="Enkripsi" /><input type="submit" name="decrypt_vigenere" value="Dekripsi" /><input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td></tr>
    </table>
</body>
</html>