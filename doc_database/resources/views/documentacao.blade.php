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
    <hr>
    <div class="search">
        <div class="upload">
            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif
            <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csv_file" accept=".csv">
                <button type="submit">Upload</button>
            </form>
        </div>    
        <hr>
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