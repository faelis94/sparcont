<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="css/estilos2.css"/>
  <title>Simulador de sálario</title>
  <meta charset="utf-8">
<link rel="sortcut icon" href="_imagens/sp.ico" type="image/x-icon" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>


  <body>
    <div class="sidebar">
      <center><img  src="_imagens/300a.png">  </center>
      <a href="#"><i class="fa fa-fw fa-user"></i> Login</a>
          </br>
      <div class="dropdown">
    <button class="dropbtn">Simulações
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="calculasalario.html">Folha</a>
      <a href="calculaferias.html">Férias</a>
      <a href="#contact">Rescisão</a>
      <a href="#contact">GPS</a>
    </div>
  </div>

  <div class="dropdown">
  <button class="dropbtn">Tabelas
  <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content">
  <a href="#contact">INSS</a>
  <a href="#contact">IRRF</a>
  <a href="#contact">Salario Fámilia</a>
  <a href="#contact">Esocial</a>
  </div>
  </div>
  </br>
  <hr/>


        <a href="#services">Serviços</a>
        <a href="#clientes">Clientes</a>
        <a href="#contact">Contato</a>
          <a href="index.html">Sobre</a>

      </br>
      </br>





  </div>
</br>
</br>
</br>

<div class="divrecibo">


    <?php
        $sl = $_GET["sl"];
        $vt= $_GET["vt"];
        $outds= $_GET["outds"];
        $outp= $_GET["outp"];
        $al=$_GET["al"];
        $falt=$_GET["falt"];
        $dsrd=$_GET["dsrd"];


  //Valor Faltas
  $falta=($sl/30)*$falt;

        //Valor VT

        if($vt==1){
          $vtf=$sl*0.06;
        }
        if($vt==0){
          $vtf=0;
        }






        //Valor INSS
        if(($sl+$outp-$falta)<=1751.81){
          $inss=($sl+$outp-$falta)*0.08;
          $aliquotainss=8;
        }
        if(($sl+$outp-$falta)>1751.81 || ($sl+$outp-$falta)<=2919.72){
          $inss=($sl+$outp-$falta)*0.09;
          $aliquotainss=9;
        }
        if(($sl+$outp-$falta)>2919.72){
          $inss=($sl+$outp-$falta)*0.11;
          $aliquotainss=11;
        }



                //Calculo Salario+Proventos
                $slir=$sl+$outp-$falta-$inss;

        //Tabela IRRF
        if($slir<1903.98){
          $irrf=0;
          $aliquotairrf=0;
        }


        if($slir>=1903.98 && $slir<=2826.65){
          $irrf=(($slir*7.5)/100)-142.80;
          $aliquotairrf=7.5;
        }
        if($slir>2826.65 && $slir<=3751.05){
          $irrf=(($slir*15)/100)-354.80;
          $aliquotairrf=15;
        }

        if($slir>3751.05 && $slir<=4664.68){
          $irrf=(($slir*22.5)/100)-636.13;
          $aliquotairrf=22;
        }
        if($slir>4664.68 ){
          $irrf=(($slir*27.5)/100)-869.36;
          $aliquotairrf=27.5;
        }


        $salario=$sl-$inss-$vtf-$irrf-$outds-$al+$outp-$dsrd-$falta;

        if ($salario<0){
          $salario=0;
        }
        $proventos=$sl+$outp;
        $descontos=$inss+$vtf+$irrf+$outds+$al+$dsrd+$falta;
        ?>
<center><h1> Demonstrativo de pagamento </h1></center>
        <div style="overflow-x:auto;">


                                    </br>
                                    </br>
                                    </br>



          <table>
            <tr>
              <th>Evento</th>
              <th>Ref.</th>
              <th>Proventos</th>
              <th>Descontos</th>

            </tr>
            <tr>
            </tr>
                       <tr>

              <td>Sálario</td>
                <td>-</td>
                <td>R$<?php echo number_format($sl, 2, '.', '') ; ?></td>
                  <td>-</td>
            </tr>

            <?php if($outp>0){
              ?>

            <tr>
              <td>Outros Proventos</td>
              <td>-</td>
                <td>R$<?php echo number_format($outp, 2, '.', '') ; ?></td>
                <td>-</td>
            </tr>
<?php   }  if($outds>0){
  ?>


            <tr>
              <td>Outros Descontos</td>
                <td>-</td>
                <td>-</td>
                <td>R$<?php echo number_format($outds, 2, '.', '') ; ?></td>
            </tr>


            <?php }  if($slir>=1903.98){ ?>
            <tr>
              <td>IRRF</td>
              <td><?php echo $aliquotairrf ; ?>%</td>
              <td>-</td>
              <td>R$<?php echo number_format($irrf, 2, '.', '') ; ?></td>

            </tr>
            <?php }  ?>


            <tr>
              <td>INSS</td>
              <td><?php echo $aliquotainss ; ?>%</td>
              <td>-</td>
              <td>R$<?php echo number_format($inss, 2, '.', ''); ?></td>
            </tr>

            <?php if($al>0){
              ?>
            <tr>
              <td>Alimentação</td>
                <td>-</td>
                  <td>-</td>
                    <td>R$<?php echo number_format($al, 2, '.', '') ; ?></td>
            </tr>


          <?php } if ($vtf>0){
              ?>
            <tr>
              <td>Vale Transporte</td>
                <td>-</td>
                  <td>-</td>
                    <td>R$<?php echo number_format($vtf, 2, '.', '') ; ?></td>
            </tr>
          <?php }

          if ($falta>0){?>


            <tr>
              <td>Faltas</td>
                <td>-</td>
                  <td>-</td>
                  <td>R$<?php echo number_format($falta, 2, '.', '') ; ?></td>
            </tr>
<?php  }  if($dsrd>0){
?>

            <tr>
              <td>DSR</td>
                <td>-</td>
                  <td>-</td>
                  <td>R$<?php echo number_format($dsrd, 2, '.', '') ; ?></td>
            </tr>

            <tr>
<?php }  ?>


              <td> </td>
              <td>Totais:</td>
            <td>R$<?php echo number_format($proventos, 2, '.', '') ; ?></td>
            <td>R$<?php echo number_format($descontos, 2, '.', '') ; ?></td>
             </tr>

             <tr>



               <td> </td>
               <td></td>
             <td>Liquido:</td>
             <th>R$<?php echo number_format($salario, 2, '.', '') ; ?></th>
              </tr>
          </table>

</br>

        </div>




              <center><a href="calculasalario.html">Voltar</a><center>
    </div>
</div>

  </body>
</html>
