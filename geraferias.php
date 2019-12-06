<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="css/estilos2.css"/>
  <title>Simulador de Ferias</title>
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
        $fven=$_GET["fven"];
        $inifer=$_GET["inifer"];
        $diasf=$_GET["diasf"];


        // 1/3 de salario
        $tersalar=($sl/$diasf)/3;

        // Remuneração de férias
          $remunferi=$sl/$diasf;

          //Remuneração de Ferias para INSS
          $inssferias=$remunferi+$tersalar;

        //Valor INSS
        if(($inssferias)<=1751.81){
          $inss=($inssferias)*0.08;
          $aliquotainss=8;
        }
        if(($inssferias)>1751.81 || ($inssferias)<=2919.72){
          $inss=($inssferias)*0.09;
          $aliquotainss=9;
        }
        if(($inssferias)>2919.72){
          $inss=($inssferias)*0.11;
          $aliquotainss=11;
        }



        //Calculo Salario+Proventos
                $slir=($tersalar+$remunferi)-$inss;

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


        //Dias de Ferias

        if ($diasf==1){
        $fimfer=$inifer;
        $fimfer = date('d/m/Y ', strtotime('+29 days', strtotime($inifer)));
        }
        if ($diasf==2){
          $fimfer=$inifer;
          $fimfer = date('d/m/Y ', strtotime('+14 days', strtotime($inifer)));
        }
        $inifer = date('d/m/Y ', strtotime($inifer));



        //Férias em Dobro
        if ($fven==1){
          $vencidos=$remunferi+$tersalar;
        }
        if ($fven==2){
          $vencidos=0;
        }



        //liquido final
        $salario=$tersalar-$inss-$irrf+$vencidos+$remunferi;

        //descontos Totais
        $descontos=$inss+$irrf;
        //Pronventos Totais
        $proventos=$vencidos+$remunferi+$tersalar;

        //Referencia de férias
        $refferias=30/$diasf;

        ?>
<center><h1> Demonstrativo de pagamento </h1></center>
<div style="overflow-x:auto;">


                            </br>
                            </br>
                            </br>



  <table>
  </tr>
  <td>Férias de: <?php echo $inifer ; ?> a  <?php echo $fimfer; ?></td>
    <tr>
      <th>Evento</th>
      <th>Ref.</th>
      <th>Proventos</th>
      <th>Descontos</th>

    </tr>
    <tr>
    </tr>
               <tr>

      <td>Remuneração Férias</td>
        <td><?php echo $refferias ; ?> dias</td>
        <td>R$<?php echo number_format($remunferi, 2, '.', '') ; ?></td>
          <td>-</td>
    </tr>

    <tr>

<td>1/3 de Férias</td>
<td>-</td>
<td>R$<?php echo number_format($tersalar, 2, '.', '') ; ?></td>
<td>-</td>
</tr>


    <?php   if($slir>=1903.98){ ?>
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



<?php  if($fven==1){
?>

    <tr>
      <td>Ferias em Dobro</td>
        <td><?php if($fven==1){
              if($diasf==1){
          echo  "30 dias" ;}
          if ($diasf==2){
            echo "15 dias";
          }
        }
        if($fven==2){
          echo "-";
        } ; ?></td>
          <td><?php if($fven==1){ ?>R$<?php  echo number_format($vencidos, 2, '.', '') ;
          }
          if ($fven==2){ echo "-"; } ?></td>
          <td>-</td>
    </tr>

    <tr>
<?php }  ?>



      <td> </td>
      <td>Totais:</td>
    <td>R$<?php echo number_format($proventos, 2, '.', '') ; ?></td>
    <td>R$<?php echo number_format($descontos, 2, '.', '') ; ?></td>
     </tr>

     <tr>



       <td></td>
       <td></td>
     <td>Liquido:</td>
     <th>R$<?php echo number_format($salario, 2, '.', '') ; ?></th>
      </tr>
  </table>

</br>

</div>
<h5>**Valores simulados não precisos. Rateio de obrigações (INSS e IRRF) por competencia não disponiveis na versão demonstração.<h5>



      <center><a href="calculaferias.html">Voltar</a><center>
</div>
</div>

  </body>
</html>
