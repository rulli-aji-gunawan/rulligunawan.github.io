<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriptografi</title>
</head>

<style>
    #page {
        padding-left : 20px;
    }

    #tblA {
        border-collapse: collapse;
    }
    #tblA td, #tblA th {
        border : 1px solid #ddd;
    }

    #tblA th {
        padding-left : 4px;
    }

    #tblA td {
        padding-left : 4px;
        padding-top : 5px;
        padding-right : 25px;
    }

    #tblA tr:nth-child(even){background-color: #f2f2f2;}

    #btEcr {
        background : pink;
        padding : 5px;
        font-size : 110%;
        font-weight : bold;
    }

    #btDcr {
        background : lightgreen;
        padding : 5px;
        font-size : 110%;
        font-weight : bold;
    }
    

    #tblB td, #tblB th, #tblC td, #tblC th {
        padding-top : 5px;
        padding-right : 15px;
        
    }

    #inptext {
        width : 300px;
    }

    #inpbaris {
        width : 50px;
    }

    #hasil {
        font-weight : bold;
        font-size : 120%;
        color : blue;
    }

</style>

<body id="page">
    <h2>TUGAS KRIPTOGRAFI - KELOMPOK 5</h2>
    <h3>Anggota kelompok :</h3>
    <table id="tblA">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Rulli Aji Gunawan</td>
            <td>311910675</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Steven </td>
            <td>3119xxxxx</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Syukur Yakub</td>
            <td>3119xxxxx</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Zane</td>
            <td>3119xxxxx</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Riwan</td>
            <td>3119xxxxx</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Rivaldi</td>
            <td>3119xxxxx</td>
            <td>TI.19.C.1</td>
        </tr>
        
    </table>

    <br><br>

    <h3>Metode Enkripsi Plaintext Dengan Algoritma Rail Fence (ZigZag)</h3>

    <table id=tblB>
        <form method="post">
            <tr>
                <td>
                    <label >
                        Input Plaintext
                    </label>
                </td>
                <td>
                    <input type="text" name="plaintext" id="inptext" />
                </td>
            </tr>
            <tr>
                <td><label for="barisE">
                        Input Jumlah Baris
                    </label>
                </td>
                <td><input type="integer" name="barisE" id="inpbaris"/>
                </td>
            </tr>  
            <tr>
                <td>
                    <label>
                        <input type="submit" name="kirimE" value="Enkripsi" id="btEcr">
                    </label>
                </td>
            </tr>         
        </form>
    </table>

    

    <?php
        if (isset($_POST["kirimE"])) {

        # Membuat array kosong mtr
            $mtr = array();
            $split = 4;
            $plaintext = $_POST["plaintext"];
            $len = strlen($plaintext);
            $mod = $len % $split;
        // Menambah unique character "Z" karena paling sedikit digunakan untuk melengkapi jumlah karakter supaya nilai mod terhadap split nya menjadi nol
            if ($mod > 0) {
                $add = $split - $mod;
                for ($i = 0; $i < $add; $i++) {
                    $plaintext .= "Z";
                }
            }

            echo "<br>";
            
            $kolE = strlen($plaintext);
            $barisE = $_POST["barisE"];
            for ($i = 0; $i < $barisE; $i++) {
                for ($j = 0; $j < $kolE; $j++) {
                    $mtr[$i][$j] = "";
                }
            } 

        # Menempatkan tiap huruf plain text secara zigzag pada array mtr            
            $row = 0;
            $check = 0;
            $kolE = strlen($plaintext);
            for ($i = 0; $i < $kolE; $i++) {
                if ($check == 0) {
                // Merubah spasi menjadi unique character "Q" karena paling sedikit digunakan
                    if ($plaintext[$i] == " ") {
                        $plaintext[$i] = "Q";
                        $mtr[$row][$i] = $plaintext[$i];
                        $row++;
                        if ($row == $barisE) {
                            $check = 1;
                            $row--;
                        }
                    }
                    else {
                        $plaintext[$i] = $plaintext[$i];
                        $mtr[$row][$i] = $plaintext[$i];
                        $row++;
                        if ($row == $barisE) {
                            $check = 1;
                            $row--;
                        }
                    }
                }
                    
                elseif ($check == 1) {
                    $row--;
                // Merubah spasi menjadi unique character "Q" karena paling sedikit digunakan
                    if ($plaintext[$i] == " ") {
                        $plaintext[$i] = "Q";
                        $mtr[$row][$i] = $plaintext[$i];
                        if ($row == 0) {
                            $check = 0;
                            $row = 1;
                        }
                    }
                    else {
                        $plaintext[$i] = $plaintext[$i];
                        $mtr[$row][$i] = $plaintext[$i];
                        if ($row == 0) {
                            $check = 0;
                            $row = 1;
                        }
                    }
                    
                }
            }

        // Menggabungkan semua elemen array mtr dalam satu string baru ct
            $ct = array();
            for ($i = 0; $i < $barisE; $i++) {
                for ($j = 0; $j < $kolE; $j++) {
                    if ($mtr[$i][$j] != " "){
                        array_push($ct, $mtr[$i][$j]);
                    }   
                }
            }

        // Memisahkan setiap 4 karakter menjadi satu blok
            $ct = str_split(strtoupper(join("",$ct)),4); 
            $ct2 = array();
            for ($i = 0; $i < count($ct); $i++) {
                array_push($ct2, $ct[$i]);
            }
            $ct = strtoupper(implode(" ",$ct2));  

            // echo 'Hasil enkripsi dari plaintext "'.$_POST["plaintext"].'" adalah : '."<br>".$ct;
            // echo "<br>";

        }
        
    ?>

    <p>
        <?php 
            if (isset($_POST["kirimE"])) {
                $plain = $_POST["plaintext"];
                echo "Hasil enkripsi dari '".$plain."' adalah :"; 
            }
         
         ?> 
    </p>  
    <p id="hasil">
         <?php 
         if (isset($_POST["kirimE"])) {
            echo $ct; 
         }
         
         ?>
    </p>
    <hr>
    <br>    

    <h3>Metode Dekripsi Chipertext Dengan Algoritma Rail Fence (ZigZag)</h3>

    <table id=tblC>
        <form method="post">
            <tr>
                <td>
                    <label for="chipertext">
                        Input Chipertext
                    </label>
                </td>
                <td><input type="text" name="chipertext" id="inptext"/>
                </td>
            </tr>
            <tr>
                <td><label for="barisD">
                        Input Jumlah Baris
                    </label>
                </td>
                <td>
                    <input type="integer" name="barisD" id="inpbaris"/>
                </td>
            </tr>  
            <tr>
                <td>
                    <label>
                        <input type="submit" name="kirimD" value="Dekripsi" id="btDcr">
                    </label>
                </td>
            </tr>           
        </form>
    </table>

    <?php
        if (isset($_POST["kirimD"])) {

        # Membuat array kosong mtr
            $mtr = array();
            $chipertext = $_POST["chipertext"];     
            $chipertext = str_replace(" ","",$chipertext);
            $kolD = strlen($chipertext);
            $barisD = $_POST["barisD"];
            for ($i = 0; $i < $barisD; $i++) {
                for ($j = 0; $j < $kolD; $j++) {
                    $mtr[$i][$j] = "";
                }
            } 

        # Menempatkan tiap huruf plain text secara zigzag pada array mtr     
            $row = 0;
            $check = 0;
            $kolD = strlen($chipertext);
            for ($i = 0; $i < $kolD; $i++) {
                if ($check == 0) {
                    $mtr[$row][$i] = $chipertext[$i];
                        $row++;
                        if ($row == $barisD) {
                            $check = 1;
                            $row--;
                    }
                }
                    
                elseif ($check == 1) {
                    $row--;
                    $mtr[$row][$i] = $chipertext[$i];
                        if ($row == 0) {
                            $check = 0;
                            $row = 1;
                    }
                    
                }
            }
            

        // Reordering atau penataan ulang array
        // Menggunakan temporary string, menambahkanelemen array ke dalam temporary string
        // Jika nilai elemen adalah kosong, maka dilanjutkan ke looping selanjutnya
        // Jika nilai elemen tidak kosong, maka nilainya digantikan oleh karakter dari chipertext index ke-"nilai order"
        // Dan jika terpenuhi, maka nilai order akan terjadi increament
            $order = 0;
            for ($i = 0; $i < $barisD; $i++) {
                for ($j = 0; $j < $kolD; $j++) {
                    $temp = "";
                    $temp .= $mtr[$i][$j];
                    if ($temp == "") {
                        continue;
                    }
                    else {
                        $mtr[$i][$j] = $chipertext[$order];
                        $order++;

                    }
                }
            }

        // Menggabungkan semua elemen array mtr kedalam satu string baru pt
            $pt = "";
            $row = 0;
            $check = 0;
            for ($i = 0; $i < $kolD; $i++) {
                if ($check == 0) {
                    $pt .= $mtr[$row][$i];
                    $row++;
                    if ($row == $barisD) {
                        $check = 1;
                        $row--;
                    }
                }
                elseif ($check == 1) {
                    $row--;
                    $pt .= $mtr[$row][$i];
                    if ($row == 0) {
                        $check = 0;
                        $row = 1;
                    }
                }
            }

        // Merubah unique character Q menjadi spasi dan "Z" dihapus
            $pt = str_replace("Q"," ",$pt);
            $pt = str_replace("Z","",$pt);

            // echo 'Hasil dekripsi dari chipertext "'.$_POST["chipertext"].'" adalah : '.$pt;
            // echo "<br>";

        }
        // print_r($mtr);
    ?>  

    <p>
        <?php 
            if (isset($_POST["kirimD"])) {
                $chiper = $_POST["chipertext"];
                echo "Hasil dekripsi dari '".$chiper."' adalah :"; 
            }
         
         ?> 
    </p>  
    <p id="hasil">
         <?php 
         if (isset($_POST["kirimD"])) {
            echo $pt; 
         }
         
         ?>
    </p>

</body>
</html>