<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Recrutamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php        
        include ('../../public/php/connect.php');
    ?>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="vagas-tab" data-bs-toggle="tab" data-bs-target="#vagas" type="button">Vagas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="candidatos-tab" data-bs-toggle="tab" data-bs-target="#candidatos" type="button">Candidatos</button>
            </li>
        </ul>

        <!-- Vagas Tab -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="vagas">
                <!-- Filtros -->
                <div class="row mt-3 g-3">
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="ID">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Título">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option>Tipo</option>
                            <option>CLT</option>
                            <option>PJ</option>
                            <option>Freelancer</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option>Status</option>
                            <option>Ativa</option>
                            <option>Inativa</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Filtrar</button>
                    </div>
                </div>

                <!-- Tabela Vagas -->
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>Pausada</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
 
                        $sql = "SELECT * FROM jobs";
                        $query = $db->query($sql);
 
                        while($row = $query->fetchArray()){

                            $status = !!$row['STATUS'] ? "Ativa" : "Inativa";

                                echo "
                                    <tr>
                                        <td>".$row['ID']."</td>
                                        <td>".$row['TITLE']."</td>
                                        <td>".$row['TYPE']."</td>
                                        <td>".$status."</td>
                                        <td>
                                            <button class='btn btn-success' id='Excluir.$row['ID'].' type='submit'>Excluir</button>    
                                        </td>
                                    </tr>
                                ";
                        }
                ?>
                    </tbody>
                </table>
                
                <!-- Paginação -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
                    </ul>
                </nav>

                <!-- Botão Nova Vaga -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalVaga">Nova Vaga</button>
            </div>

            <!-- Candidatos Tab -->
            <div class="tab-pane fade" id="candidatos">
                <!-- Filtros -->
                <div class="row mt-3 g-3">
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="ID">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Nome">
                    </div>
                    <div class="col-md-3">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Filtrar</button>
                    </div>
                </div>

                <!-- Tabela Candidatos -->
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Habilidades</th>
                            <th>Vagas Inscritas</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Exemplo de linha -->
                        <tr>
                            <td>1</td>
                            <td>João Silva</td>
                            <td>joao@email.com</td>
                            <td>JavaScript, HTML, CSS</td>
                            <td>2</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Editar</button>
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Paginação -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
                    </ul>
                </nav>

                <!-- Botão Novo Candidato -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCandidato">Novo Candidato</button>
            </div>
        </div>
    </div>

    <!-- Modal Vaga -->
    <div class="modal fade" id="modalVaga">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Vaga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Título*</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descrição*</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo*</label>
                            <select class="form-select" required>
                                <option value="">Selecione</option>
                                <option>CLT</option>
                                <option>PJ</option>
                                <option>Freelancer</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="vagaPausada">
                            <label class="form-check-label" for="vagaPausada">Vaga Pausada</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Candidato -->
    <div class="modal fade" id="modalCandidato">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Candidato</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nome*</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email*</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Habilidades*</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vagas</label>
                            <select class="form-select" multiple>
                                <option>Desenvolvedor Front-end</option>
                                <option>Designer UX</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            
            $('#Excluir').click(function() {
                
                id = document.querySelector('#deleteJobs').value

                var dados = {"id": id};
    
                if(dados != null || dados != '' ){
    
                    $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../public/php/deleteJoBS',
                    async: true,
                    data: dados,
                    success: function(response) {
                        if(response.success) {
                            alert("Excluido!");
                        }
                    }
                    
                });
    
                }
                
                return false;
            });
        });
    </script>

</body>
</html>