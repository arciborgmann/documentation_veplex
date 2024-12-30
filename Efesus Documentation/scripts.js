document.addEventListener('DOMContentLoaded', function () {
    const menu = document.querySelector('nav > ul'); // Seleciona o menu principal
    const toggleButton = document.querySelector('.menu-toggle'); // Botão do menu hambúrguer
    const menuItems = document.querySelectorAll('nav li[data-content]'); // Itens do menu
    const mainContent = document.getElementById('content'); // Área de conteúdo dinâmico

    // Função para ordenar itens do menu e submenus
    function ordenarMenu(menuElement) {
        const items = Array.from(menuElement.children);
        
        // Ordena os itens de forma alfabética
        items.sort((a, b) => {
            const textA = a.textContent.trim().toLowerCase();
            const textB = b.textContent.trim().toLowerCase();
            return textA.localeCompare(textB);
        });

        // Limpa o menu e adiciona os itens ordenados
        menuElement.innerHTML = '';
        items.forEach(item => {
            // Verifica se o item tem submenu e ordena também
            const submenu = item.querySelector('ul');
            if (submenu) {
                ordenarMenu(submenu); // Ordena o submenu recursivamente
            }
            menuElement.appendChild(item); // Adiciona o item ordenado
        });
    }

    // Ordena o menu principal
    if (menu) {
        ordenarMenu(menu);
        console.log('Itens do menu e submenus ordenados.');
    }

    // Função para alternar a visibilidade do menu hambúrguer
    if (toggleButton && menu) {
        toggleButton.addEventListener('click', () => {
            // Altera o estado do menu (exibe ou esconde)
            menu.classList.toggle('show');
            // Alterna o ícone do hambúrguer para "X"
            toggleButton.classList.toggle('open');
        });
    }

    // Função para carregar conteúdo dinâmico
    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            const contentName = item.getAttribute('data-content');

            // Limpa o conteúdo anterior e exibe um indicador de carregamento
            mainContent.innerHTML = 'Carregando...';

            // Carrega o conteúdo do arquivo HTML correspondente
            if (contentName) {
                fetch(`pages/${contentName}.html`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Falha ao carregar ${contentName}.html: ${response.statusText}`);
                        }
                        return response.text();
                    })
                    .then(data => {
                        mainContent.innerHTML = data;
                    })
                    .catch(error => {
                        mainContent.innerHTML = `Erro ao carregar o conteúdo: ${error.message}`;
                    });
            }
        });
    });
});
