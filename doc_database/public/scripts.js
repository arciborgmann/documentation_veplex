function toggleContent(id) {
    const content = document.getElementById(id);
    if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
}

function toggleUpload() {
    const uploadBlock = document.getElementById('upload-block');
    const toggleButton = document.getElementById('toggle-upload-button');
    const tableFormBlock = document.getElementById('table-form-block');
    const tableButton = document.getElementById('toggle-table-button');

    // Alterna a exibição do bloco
    if (uploadBlock.style.display === 'none' || uploadBlock.style.display === '') {
        uploadBlock.style.display = 'block';
        tableFormBlock.style.display = 'none';
        toggleButton.textContent = 'Fechar'; 
        tableButton.textContent = 'Tabela';
    } else {
        uploadBlock.style.display = 'none';
        toggleButton.textContent = 'Arquivo'; // Atualiza o texto para "Arquivo"
    }
}

function toggleTableForm() {
    const tableFormBlock = document.getElementById('table-form-block');
    const tableButton = document.getElementById('toggle-table-button');
    const uploadBlock = document.getElementById('upload-block');
    const toggleButton = document.getElementById('toggle-upload-button');

    if (tableFormBlock.style.display === 'none' || tableFormBlock.style.display === '') {
        tableFormBlock.style.display = 'block';
        tableButton.textContent = 'Fechar';
        uploadBlock.style.display = 'none';
        toggleButton.textContent = 'Arquivo';
    } else {
        tableFormBlock.style.display = 'none';
        tableButton.textContent = 'Tabela';
    }
}

// Função que atualiza os valores dos cards com a quantidade de tabelas e campos encontrados
function atualizarInformacoes(tabelas, campos) {
    document.getElementById('tabelas-count').innerText = tabelas;
    document.getElementById('campos-count').innerText = campos;
}

function filterTables() {
    const searchInput = document.getElementById("search").value.toLowerCase();
    const searchTables = document.getElementById("tabelas").checked;
    const searchFields = document.getElementById("campos").checked;
    const headers = document.querySelectorAll(".table-header");

    let tabelasEncontradas = 0; // Contador de tabelas encontradas
    let camposEncontrados = 0; // Contador de campos encontrados

    headers.forEach(header => {
        const tableName = header.querySelector("h2").textContent.toLowerCase(); // Nome da tabela
        const tableContent = header.nextElementSibling; // Conteúdo da tabela
        let matchFound = false;

        // Selecionar todas as células da tabela, exceto a coluna "Descrição"
        const tableCells = Array.from(tableContent.querySelectorAll("td")).filter(cell => {
            const columnIndex = Array.from(cell.parentElement.children).indexOf(cell); // Índice da célula
            return columnIndex == 0; 
        });

        // Limpar destaques anteriores
        tableCells.forEach(cell => clearHighlights(cell));

        // Contador para campos encontrados apenas nas tabelas correspondentes
        let camposPorTabela = 0;

        // Cenário 01: Nenhum checkbox selecionado (buscar em tabelas e campos)
        if (!searchTables && !searchFields) {
            // Buscar no nome da tabela
            if (tableName.includes(searchInput)) {
                matchFound = true;
                tabelasEncontradas++;
            }
            // Buscar nos campos e destacar
            tableCells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(searchInput)) {
                    matchFound = true;
                    highlightText(cell, searchInput);
                    camposEncontrados++;
                }
            });
        }

        // Cenário 02: "Tabelas" selecionado (buscar no nome da tabela, destacar campos)
        if (searchTables && !searchFields) {
            // Buscar no nome da tabela
            if (tableName.includes(searchInput)) {
                matchFound = true;
                tabelasEncontradas++;

                // Contar campos apenas nas tabelas correspondentes
                tableCells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchInput)) {
                        highlightText(cell, searchInput);
                        camposPorTabela++;
                    }
                });
            }
        }

        // Cenário 03: "Campos" selecionado (buscar e destacar nos campos)
        if (!searchTables && searchFields) {
            // Buscar apenas nos campos
            tableCells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(searchInput)) {
                    matchFound = true;
                    highlightText(cell, searchInput);
                    camposEncontrados++;
                }
            });
        }

        // Atualizar a contagem de campos para tabelas correspondentes
        if (searchTables && !searchFields) {
            camposEncontrados += camposPorTabela;
        }

        // Mostrar ou ocultar cabeçalhos baseado na correspondência
        if (matchFound) {
            header.style.display = "flex"; // Mostra o cabeçalho
        } else {
            header.style.display = "none"; // Oculta o cabeçalho
        }

        // Manter as tabelas colapsadas
        tableContent.style.display = "none"; // A tabela permanece oculta
    });

    // Atualizar os valores dos cards
    atualizarInformacoes(tabelasEncontradas, camposEncontrados);

    // Limpar destaques se o campo de pesquisa estiver vazio
    if (!searchInput) {
        headers.forEach(header => {
            const tableContent = header.nextElementSibling;
            const tableCells = tableContent.querySelectorAll("td");
            tableCells.forEach(cell => clearHighlights(cell)); // Limpar qualquer destaque
        });
    }
}

// Função para limpar os destaques
function clearHighlights(cell) {
    cell.innerHTML = cell.textContent; // Remove tags de destaque
}

// Função para destacar texto
function highlightText(cell, term) {
    const regex = new RegExp(`(${term})`, "gi");
    cell.innerHTML = cell.textContent.replace(regex, "<span class='highlight'>$1</span>");
}

// Função que atualiza os valores dos cards com a quantidade de tabelas e campos encontrados
function atualizarInformacoes(tabelas, campos) {
    document.getElementById("tabelas-count").innerText = tabelas;
    document.getElementById("campos-count").innerText = campos;
}

document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector('.container'); // Busca pelo elemento com a classe 'container'
    if (!container) {
        console.error("Elemento com a classe 'container' não encontrado.");
        return; // Para a execução se o container não existir
    }

    // Código de ordenação de tabelas
    const tablePairs = Array.from(container.querySelectorAll('.table-header')).map(header => {
        return {
            header: header,
            content: header.nextElementSibling // O conteúdo logo após o cabeçalho
        };
    });

    // Ordena os pares com base no texto do h2 dentro do cabeçalho
    tablePairs.sort((a, b) => {
        const nameA = a.header.querySelector('h2').innerText.trim().toLowerCase();
        const nameB = b.header.querySelector('h2').innerText.trim().toLowerCase();
        return nameA.localeCompare(nameB); // Ordena de forma alfabética
    });

    // Remove todos os elementos atuais do container
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }

    // Reanexa os elementos no container na nova ordem
    tablePairs.forEach(pair => {
        container.appendChild(pair.header);  // Adiciona o cabeçalho
        container.appendChild(pair.content); // Adiciona o conteúdo correspondente
    });
});

// Função para deletar uma tabela
function deleteTable(button, tabelaId) {
    if (confirm('Tem certeza que deseja excluir esta tabela?')) {
        // Realize a exclusão via AJAX ou redirecione para uma rota de exclusão
        fetch(`/tabelas/${tabelaId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if (response.ok) {
                button.closest('.table-header').remove();  // Remove a tabela do DOM
                button.closest('.table-content').remove();
            }
        });
    }
}

// Função para deletar um campo
function deleteField(button, campoId) {
    if (confirm('Tem certeza que deseja excluir este campo?')) {
        // Realize a exclusão via AJAX ou redirecione para uma rota de exclusão
        fetch(`/campos/${campoId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if (response.ok) {
                button.closest('tr').remove();  // Remove a linha do campo
            }
        });
    }
}
