<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Documentation</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <header class="page-header">
        <img src="{{ asset('img/logo-veplex.png') }}" alt="Veplex" class="company-logo">
        <h1 class="header-title">Database Documentation</h1>
    </header>
    <div class="search">
        <div class="control-buttons">
            <!-- Botão para upload -->
            <button class="upload-button" onclick="toggleUpload()" id="toggle-upload-button">+ Arquivo</button>
            
            <!-- Botão para adicionar tabela 
            <button class="table-button" onclick="toggleTableForm()" id="toggle-table-button">Tabela</button> -->
        </div>

        <!-- Bloco de upload -->
        <div id="upload-block" style="display: none;">
            <form class="upload-form" action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="file-input-wrapper">
                    <label class="file-label" for="csv_file">Selecione o arquivo</label>
                    <input id="csv_file" type="file" name="csv_file" accept=".csv" class="file-input">
                </div>
                <button type="submit" class="upload-button">Upload</button>
            </form>
        </div>

        <!-- Bloco de adição de tabela -->
        <div id="table-form-block" style="display: none;">
            <form>
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="tabela">Tabela</label>
                        <input type="text" id="tabela" name="tabela" placeholder="Nome da Tabela">
                    </div>
                    <div class="form-group">
                        <label for="campo">Campo</label>
                        <input type="text" id="campo" name="campo" placeholder="Nome do Campo">
                    </div>
                    <div class="form-group pk">
                        <label for="pk">PK</label>
                        <input type="checkbox" id="pk" name="pk">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" id="tipo" name="tipo" placeholder="Tipo do Campo">
                    </div>
                    <div class="form-group description-with-button">
                        <label for="descricao">Descrição</label>
                        <div class="description-input-wrapper">
                            <input type="text" id="descricao" name="descricao" placeholder="Descrição">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="save-button">Salvar</button>
                    </div>
                </div>  
            </form>
        </div>
        <!-- Cards de informações -->
        <div class="info-cards-container">
            <div class="info-card">
                <h3>Tabelas Encontradas</h3>
                <p id="tabelas-count">{{ $tabelas->count() }}</p> <!-- Número de tabelas -->
            </div>
            <div class="info-card">
                <h3>Campos Encontrados</h3>
                <p id="campos-count">{{ $tabelas->sum(fn($t) => $t->campos->count()) }}</p> <!-- Total de campos -->
            </div>
        </div>
        <div>
            <input type="text" id="search" placeholder="Busque por tabela, campo ou descrição..." oninput="filterTables()">
        </div>
        <div class="checkbox-container">
            <div class="checkbox-item">
                <input type="checkbox" id="tabelas" onchange="filterTables()">
                <label for="tabelas">Tabelas</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="campos" onchange="filterTables()">
                <label for="campos">Campos</label>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        @foreach($tabelas as $tabela)
            <div class="table-header" onclick="toggleContent('tabela-{{ $tabela->id }}')">
                <h2>{{ $tabela->nome }}</h2>
                <span>▼</span>
            </div>
            <div id="tabela-{{ $tabela->id }}" class="table-content" data-type="tabela">
                <p class="description">{{ $tabela->descricao }}</p>
                <table>
                    <thead>
                        <tr>
                            <th>Nome do Campo</th>
                            <th class="pkey">PK</th>
                            <th>Tipo do Campo</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tabela->campos as $campo)
                            <tr>
                                <td>{{ $campo->nome }}</td>
                                <td class="pkey">{{ $campo->is_primary_key ? 'X' : '' }}</td>
                                <td>{{ $campo->tipo }}</td>
                                <td>{{ $campo->descricao }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

    <footer class="page-footer">
        <img src="{{ asset('img/logo-veplex.png') }}" alt="Veplex" class="company-logo-footer">
        <h1 class="footer-title">2025 - Todos os direitos reservados.</h1>
    </footer>
    <script src="{{ asset('scripts.js') }}"></script>
</body>
</html>