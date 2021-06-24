<?php
session_start();
include_once("conexao.php");
// include_once("lista_eventos.php");
//  include_once("sql.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='css/main.min.css' rel='stylesheet' />
<link rel="stylesheet" type="text/css" href="css/pikaday.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<link rel="stylesheet" href="css/style.css">


<script src='js/main.min.js'></script>
<script src='js/locales-all.min.js'></script>
<script src="js/pikaday.js"></script>
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/personalizado.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light corNavbar">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<form >
  <select  class="form-control corSelect" name="dentista_id" id="dentista_id">
    <option selected>Selecione a agenda</option>
    <?php
        $query_dentistas = "SELECT * FROM dentistas";
        $resultado_dentistas = $conn->prepare($query_dentistas);
        $resultado_dentistas->execute();

        while($row_dentista = $resultado_dentistas->fetch(PDO::FETCH_ASSOC)){
    ?>
        <option value="<?php echo $row_dentista['id']; ?>"><?php echo $row_dentista['nome']; ?>
        </option>
    <?php    
        }
    ?>    
  </select>
 
</form>

  <div id='calendar'></div>
<!-- modal cadastrar -->
<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="pull-left modal-title text-center">Adicionar agendamento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="cadastrar_evento.php">
          <div class="form-row">
             <div class="col-sm-6 bottom form-group">
                <label for="procedimento">Tipo de agendamento</label>
                  <select class="form-control input-sm" id="procedimento" name="procedimento">
                    <option>Selecione</option>
                    <option>Avaliação</option>
                    <option>Ortodontia</option>
                    <option>Implante</option>
                    <option>Prótese</option>
                    <option>Cirurgia</option>
                    <option>Volta</option>
                    </select>
              </div>
              <div id="custom-search-input" class="col-sm-12 bottom form-group">
                <div class="form-group">
                  <label for="inputEmail3" class=" control-label">Paciente</label>
                  <input type="text" name="title" id="title" class="form-control input-sm" placeholder="Buscar paciente"/>
                  <div class="pull-right search">
                    <i class="glyphicon glyphicon-search search  "></i>
                  </div>  
                </div>
              </div>
              <div class="col-md-6 col-sm-12 bottom">
                <label for="inputEmail3" class=" control-label">Telefone</label>
                <input type="number" maxlength="9" class="form-control" name="phone">
              </div>                                     
              <div class="col-md-6 col-sm-12 bottom">
                <label for="inputEmail3" class=" control-label">Telefone</label>
                <input type="number" maxlength="9" class="form-control" name="phone" >
              </div>
              <div class="col-sm-12 bottom">
                <label for="dentista">Dentista</label>
                <select  class="form-control" name="dentista_id" id="dentista">
                  <option selected>Selecione</option>
                  <?php
                      $query_dentistas = "SELECT * FROM dentistas";
                      $resultado_dentistas = $conn->prepare($query_dentistas);
                      $resultado_dentistas->execute();

                      while($row_dentista = $resultado_dentistas->fetch(PDO::FETCH_ASSOC)){
                  ?>
                      <option value="<?php echo $row_dentista['id']; ?>"><?php echo $row_dentista['nome']; ?>
                      </option>
                  <?php    
                      }
                  ?>    
                </select>
              </div>
              <div class="col-sm-12 bottom ">
                <div class="hora form-row">
                  <div class="col-sm-4">
                    <label for="inputEmail3" class=" control-label">Data</label>
                    <input type="phone" class="form-control dateMask" name="startdate" id="startdate">
                  </div>
                  <div class="col-sm-3">
                  <label for="inputEmail3" class=" control-label">Horário</label>
                  <input type="text" class="form-control horaMask" name="starttime" id="starttime">
                  </div>
                  <div class="col-sm-2 top" id="as">
                    <p>Às</p>
                  </div>
                  <div class="col-sm-3 top">
                    <input type="phone" class="form-control horaMask" name="endtime" id="endtime">
                  </div>   
                  <div class="hidden">
                    <input type="phone" class="form-control top" name="start" id="start" onKeyPress="DataHora(event, this)">
                  </div>  
                  <div class="hidden">
                    <input type="phone" class="form-control top" name="end" id="end" onKeyPress="DataHora(event, this)">
                  </div>  
                </div>
              </div>
              <div class=" col-sm-12 bottom" > <!-- color -->                                    
                <label for="inputEmail3" class=" control-label">Cor</label>
                  <select name="color" class="form-control" id="color">
                    <option value="">Selecione</option>     
                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                    <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>  
                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                    <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                    <option style="color:#228B22;" value="#228B22">Verde</option>
                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                  </select>
              </div>
              <div class="col-sm-12 bottom">
                <label for="inputEmail3" class=" control-label" >Observações</label>
                  <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
              </div>
              <div class="col-sm-4 margin">
                <button type="submit" class="btn btn-success">Cadastrar</button>
              </div>      
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!-- fim modal cadastrar --> 
  <!-- modal visualizar -->

  <div class="modal fade" id="visualizar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="pull-left modal-title text-center">Dados do Agentamento</h4>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- <div class="modal-body">
        <form>
          <div class="row">
            <div class="form-group">
              <label for="procedimento" class=" control-label">Tipo agendamento</label>
              <output type="text" class="form-control" id="procedimento"></output>
            </div>
          </div>  
        </form>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
   </div> -->

   <!-- <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static"> -->
    <!-- <div class="modal-dialog" role="document">
      <div class="modal-content"> -->
      <!-- <div class="modal-header"> -->
          <!-- <h4 class="pull-left modal-title text-center">Dados do Agentamento</h4> -->
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
          </div>
        </div>
      </div> -->


        <div class="modal-body">
            <div id="editar">
              <form class="form">  
                <div class="form-group row">
                  <label for="visProcedimento" class="col-sm-3 col-form-label">Procedimento</label>
                  <div class="col-sm-9">
                    <output type="text" class="form-control procedimento" id="visProcedimento">
                  </div>
                </div>
                <div class="row">
                  <!-- <div class="col-md-6 col-sm-12 bottom">
                      <div class="form-group">
                        <label for="procedimento" class=" control-label col-sm-4 col-form-label">Tipo agendamento</label>
                        <output type="text" class="form-control procedimento col-sm-8"></output>
                      </div>
                  </div>                    -->
                  <div class="col-sm-12 bottom">
                    <div class="form-group">
                      <label for="title" class=" control-label col-sm-2 col-form-label">Paciente</label>
                      <output type="text" id="title" class="form-control input-sm col-sm-10"></output>                        
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 bottom">
                    <div class="form-group">
                      <label for="telefone1" class=" control-label">Telefone</label>
                      <output type="text"class="form-control" id="telefone1"></output>
                    </div>
                  </div>                                     
                  <div class="col-md-6 col-sm-12 bottom">
                    <div class="form-group">
                      <label for="telefone2" class=" control-label">Telefone</label>
                      <output type="text"class="form-control" id="telefone2"></output>
                    </div>
                  </div>
                  <div id="custom-search-input" class="col-sm-12 bottom">
                    <div class="input-group">
                      <label for="dentist" class=" control-label">Dentista</label>
                      <output type="text" class="form-control" id="dentist"></output>
                    </div>
                  </div>
                  <div class="col-sm-12 bottom">
                    <div class="hora col-sm-12">
                      <div class="col-sm-5">
                        <label for="inputEmail3" class=" control-label">Data</label>
                        <output type="text" class="form-control " id="startdate"></output>
                      </div>
                      <div class="col-sm-3">
                      <label for="inputEmail3" class=" control-label">Horário</label>
                      <output type="text" class="form-control " id="starttime"></output>
                      </div>
                      <div class="col-sm-1 top">
                        <p>Até</p>
                      </div>
                      <div class="col-sm-3 top">
                        <output type="text" class="form-control" id="endtime"></output>
                      </div>    
                    </div>
                  </div>
                  <div class="col-sm-12 bottom">
                    <label for="inputEmail3" class=" control-label" >Observações</label>
                      <textarea class="form-control" id="observacoes" rows="3"></textarea>
                  </div>
                  <div class="col-sm-4 margin">
                    <button id="alterar" type="button" class="btn btn-warning btn-toggle">Editar</button>
                  </div>      
                </div>
              </form>
            </div><!--fim id editar -->
              <div id="form">
                <form class="form-horizontal" method="POST" action="editar_evento.php">
                  <div class="row">
                    <div class="col-sm-6 bottom">
                      <label for="tipoProcedimento">Tipo de agendamento</label>
                        <select class="form-control" class="form-control tipoProcedimento" name="procedimento">
                          <option>Selecione</option>
                          <option>Avaliação</option>
                          <option>Ortodontia</option>
                          <option>Implante</option>
                          <option>Prótese</option>
                          <option>Cirurgia</option>
                          <option>Volta</option>
                          </select>
                    </div>                   
                    <div id="custom-search-input" class="col-sm-12 bottom">
                      <div class="input-group-prepend">
                        <label for="inputEmail3" class=" control-label">Paciente</label>
                        <input type="text" name="title" id="title" class="form-control input-sm" placeholder="Buscar paciente"/>
                        <div class="pull-right search">
                          <i class="glyphicon glyphicon-search search  "></i>
                        </div>  
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 bottom">
                      <label for="inputEmail3" class=" control-label">Telefone</label>
                      <input type="number" maxlength="9" class="form-control" name="phone">
                    </div>                                     
                    <div class="col-md-6 col-sm-12 bottom">
                      <label for="inputEmail3" class=" control-label">Telefone</label>
                      <input type="number" maxlength="9" class="form-control" name="phone" >
                    </div>
                    <div id="custom-search-input" class="col-sm-12 bottom">
                      <div class="input-group-prepend ">
                        <label for="inputEmail3" class=" control-label">Dentista</label>
                        <input type="text" class="form-control " placeholder="Buscar dentista"/>
                        <div class="pull-right search">
                          <i class="glyphicon glyphicon-search search  "></i>
                        </div>  
                      </div>
                    </div>
                    <div class="col-sm-12 bottom">
                      <div class="hora col-sm-12">
                        <input type="hidden" class="form-control" name="id" id="id">  
                        <div class="col-sm-5">
                          <label for="inputEmail3" class=" control-label">Data</label>
                          <input type="phone" class="form-control dateMask" name="startdate" id="startdate">
                        </div>
                        <div class="col-sm-3">
                        <label for="inputEmail3" class=" control-label">Horário</label>
                        <input type="text" class="form-control horaMask" name="starttime" id="starttime">
                        </div>
                        <div class="col-sm-1 top">
                          <p>Até</p>
                        </div>
                        <div class="col-sm-3 top">
                          <input type="text" class="form-control horaMask" name="endtime" id="endtime">
                        </div>   
                          <input type="text" class="hidden" name="id" id="id">
                          <input type="text" class="hidden" name="start" id="startdata" onKeyPress="DataHora(event, this)">
                          <input type="text" class="hidden" name="end" id="enddata" onKeyPress="DataHora(event, this)">                     
                      </div>
                    </div>
                    <div class=" col-sm-12 bottom" > <!-- color -->                                    
                      <label for="inputEmail3" class=" control-label">Cor</label>
                        <select name="color" class="form-control" id="color">
                          <option value="">Selecione</option>     
                          <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                          <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                          <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                          <option style="color:#8B4513;" value="#8B4513">Marrom</option>  
                          <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                          <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                          <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                          <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                          <option style="color:#228B22;" value="#228B22">Verde</option>
                          <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                        </select>
                    </div>
                    <div class="col-sm-12 bottom">
                      <label for="inputEmail3" class=" control-label" >Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
                    </div>
                    <div class="col-sm-6 margin">
                      <button type="button" id="cancelar" class="btn btn-warning btn-toggle">Cancelar</button>
                      <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    </div>      
                  </div>
                </form>
              </div><!-- fim id form -->
          </div>  
      </div>
    </div>
  </div><!-- fim modal visualizar -->
</body>
</html>
