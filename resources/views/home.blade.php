<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - L2JDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #2ecc71;
            --error-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-bg: #2c3e50;
        }

        body {
            background-color: #f5f6fa;
            color: var(--primary-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--dark-bg);
            color: white;
            padding: 2rem 1rem;
            overflow-y: auto;
        }

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            color: white;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--accent-color);
        }

        .nav-link {
            color: #ecf0f1;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            background-color: var(--accent-color);
            color: white;
        }

        .nav-link i {
            width: 20px;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            width: calc(100% - 280px);
        }

        .page-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .endpoint {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .endpoint-header {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 3px solid var(--accent-color);
        }

        .endpoint-content {
            display: none;
            padding-top: 1.5rem;
        }

        .endpoint.active .endpoint-content {
            display: block;
        }

        .endpoint.active .endpoint-header i.fa-chevron-down {
            transform: rotate(180deg);
        }

        .method {
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: white;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .post {
            background-color: var(--success-color);
        }

        .get {
            background-color: var(--accent-color);
        }

        .test-form {
            background-color: var(--light-bg);
            padding: 2rem;
            border-radius: 10px;
            margin-top: 1.5rem;
        }

        .test-form h4 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .response {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 1.5rem;
            border: 1px solid #e9ecef;
        }

        pre {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 0;
            overflow-x: auto;
        }

        .documentation-section {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .documentation-section h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .error-list {
            list-style: none;
            padding: 0;
        }

        .error-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .error-list li:last-child {
            border-bottom: none;
        }

        .error-list strong {
            color: var(--error-color);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .endpoint {
            animation: fadeIn 0.5s ease-out;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .container {
                padding: 1rem;
            }

            .endpoint {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2 class="sidebar-title">API L2JDB</h2>
        <nav>
            <a href="#create-account" class="nav-link" onclick="scrollToEndpoint('create-account')">
                <i class="fas fa-user-plus"></i> Criar Conta
            </a>
            <a href="#login" class="nav-link" onclick="scrollToEndpoint('login')">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="#create-character" class="nav-link" onclick="scrollToEndpoint('create-character')">
                <i class="fas fa-user"></i> Criar Personagem
            </a>
            <a href="#list-characters" class="nav-link" onclick="scrollToEndpoint('list-characters')">
                <i class="fas fa-list"></i> Listar Personagens
            </a>
            <a href="#character-details" class="nav-link" onclick="scrollToEndpoint('character-details')">
                <i class="fas fa-user-circle"></i> Detalhes do Personagem
            </a>
            <a href="#error-codes" class="nav-link" onclick="scrollToEndpoint('error-codes')">
                <i class="fas fa-exclamation-triangle"></i> Códigos de Erro
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">Documentação da API L2JDB</h1>
        
        <!-- Criar Conta -->
        <div id="create-account" class="endpoint">
            <div class="endpoint-header" onclick="toggleEndpoint(this)">
                <h2><i class="fas fa-user-plus"></i> Criar Conta</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="endpoint-content">
                <p><span class="method post">POST</span> /api/v1/accounts</p>
                
                <div class="test-form">
                    <h4><i class="fas fa-vial"></i> Testar API</h4>
                    <form id="createAccountForm" class="mb-3">
                        <div class="mb-3">
                            <label for="createLogin" class="form-label">Login:</label>
                            <input type="text" class="form-control" id="createLogin" required>
                        </div>
                        <div class="mb-3">
                            <label for="createPassword" class="form-label">Senha:</label>
                            <input type="password" class="form-control" id="createPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="createAccessLevel" class="form-label">Nível de Acesso:</label>
                            <input type="number" class="form-control" id="createAccessLevel" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="createLastServer" class="form-label">Último Servidor:</label>
                            <input type="number" class="form-control" id="createLastServer" value="1">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Criar Conta
                        </button>
                    </form>
                    <div id="createResponse" class="response"></div>
                </div>

                <div class="documentation-section">
                    <h4><i class="fas fa-book"></i> Documentação</h4>
                    <pre>
{
    "login": "usuario123",
    "password": "senha123",
    "access_level": 0,
    "lastServer": 1
}</pre>
                </div>
            </div>
        </div>

        <!-- Login -->
        <div id="login" class="endpoint">
            <div class="endpoint-header" onclick="toggleEndpoint(this)">
                <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="endpoint-content">
                <p><span class="method post">POST</span> /api/v1/accounts/login</p>
                
                <div class="test-form">
                    <h4><i class="fas fa-vial"></i> Testar API</h4>
                    <form id="loginForm" class="mb-3">
                        <div class="mb-3">
                            <label for="loginUsername" class="form-label">Login:</label>
                            <input type="text" class="form-control" id="loginUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Senha:</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>
                    <div id="loginResponse" class="response"></div>
                </div>

                <div class="documentation-section">
                    <h4><i class="fas fa-book"></i> Documentação</h4>
                    <pre>
{
    "login": "usuario123",
    "password": "senha123"
}</pre>
                </div>
            </div>
        </div>

        <!-- Criar Personagem -->
        <div id="create-character" class="endpoint">
            <div class="endpoint-header" onclick="toggleEndpoint(this)">
                <h2><i class="fas fa-user"></i> Criar Personagem</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="endpoint-content">
                <p><span class="method post">POST</span> /api/v1/characters</p>
                
                <div class="test-form">
                    <h4><i class="fas fa-vial"></i> Testar API</h4>
                    <form id="createCharacterForm" class="mb-3">
                        <div class="mb-3">
                            <label for="accountName" class="form-label">Nome da Conta:</label>
                            <select class="form-control" id="accountName" required>
                                <option value="">Selecione uma conta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="charName" class="form-label">Nome do Personagem:</label>
                            <input type="text" class="form-control" id="charName" required>
                        </div>
                        <div class="mb-3">
                            <label for="race" class="form-label">Raça (0-5):</label>
                            <input type="number" class="form-control" id="race" min="0" max="5" required>
                        </div>
                        <div class="mb-3">
                            <label for="classid" class="form-label">Classe (0-136):</label>
                            <input type="number" class="form-control" id="classid" min="0" max="136" required>
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sexo (0-1):</label>
                            <input type="number" class="form-control" id="sex" min="0" max="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="face" class="form-label">Face (0-3):</label>
                            <input type="number" class="form-control" id="face" min="0" max="3" required>
                        </div>
                        <div class="mb-3">
                            <label for="hairStyle" class="form-label">Estilo do Cabelo (0-4):</label>
                            <input type="number" class="form-control" id="hairStyle" min="0" max="4" required>
                        </div>
                        <div class="mb-3">
                            <label for="hairColor" class="form-label">Cor do Cabelo (0-3):</label>
                            <input type="number" class="form-control" id="hairColor" min="0" max="3" required>
                        </div>
                        <div class="mb-3">
                            <label for="x" class="form-label">Coordenada X:</label>
                            <input type="number" class="form-control" id="x" required>
                        </div>
                        <div class="mb-3">
                            <label for="y" class="form-label">Coordenada Y:</label>
                            <input type="number" class="form-control" id="y" required>
                        </div>
                        <div class="mb-3">
                            <label for="z" class="form-label">Coordenada Z:</label>
                            <input type="number" class="form-control" id="z" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Criar Personagem
                        </button>
                    </form>
                    <div id="createCharacterResponse" class="response"></div>
                </div>

                <div class="documentation-section">
                    <h4><i class="fas fa-book"></i> Documentação</h4>
                    <pre>
{
    "account_name": "usuario123",
    "char_name": "Personagem1",
    "race": 0,
    "classid": 0,
    "sex": 0,
    "face": 0,
    "hairStyle": 0,
    "hairColor": 0,
    "x": 0,
    "y": 0,
    "z": 0
}</pre>
                </div>
            </div>
        </div>

        <!-- Listar Personagens da Conta -->
        <div id="list-characters" class="endpoint">
            <div class="endpoint-header" onclick="toggleEndpoint(this)">
                <h2><i class="fas fa-list"></i> Listar Personagens da Conta</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="endpoint-content">
                <p><span class="method get">GET</span> /api/v1/accounts/{accountName}/characters</p>
                
                <div class="test-form">
                    <h4><i class="fas fa-vial"></i> Testar API</h4>
                    <form id="listCharactersForm" class="mb-3">
                        <div class="mb-3">
                            <label for="listAccountName" class="form-label">Nome da Conta:</label>
                            <input type="text" class="form-control" id="listAccountName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Listar Personagens
                        </button>
                    </form>
                    <div id="listCharactersResponse" class="response"></div>
                </div>
            </div>
        </div>

        <!-- Ver Detalhes do Personagem -->
        <div id="character-details" class="endpoint">
            <div class="endpoint-header" onclick="toggleEndpoint(this)">
                <h2><i class="fas fa-user-circle"></i> Ver Detalhes do Personagem</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="endpoint-content">
                <p><span class="method get">GET</span> /api/v1/characters/{id}</p>
                
                <div class="test-form">
                    <h4><i class="fas fa-vial"></i> Testar API</h4>
                    <form id="getCharacterForm" class="mb-3">
                        <div class="mb-3">
                            <label for="characterId" class="form-label">ID do Personagem:</label>
                            <input type="number" class="form-control" id="characterId" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Ver Detalhes
                        </button>
                    </form>
                    <div id="getCharacterResponse" class="response"></div>
                </div>
            </div>
        </div>

        <!-- Códigos de Erro -->
        <div id="error-codes" class="endpoint">
            <div class="endpoint-header" onclick="toggleEndpoint(this)">
                <h2><i class="fas fa-exclamation-triangle"></i> Códigos de Erro</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="endpoint-content">
                <ul class="error-list">
                    <li><strong>401 Unauthorized</strong> - Login ou senha inválidos</li>
                    <li><strong>422 Unprocessable Entity</strong> - Erro de validação</li>
                    <li><strong>500 Internal Server Error</strong> - Erro interno do servidor</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Configuração do CSRF token para todas as requisições
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const API_BASE_URL = 'http://127.0.0.1:8000/api/v1';

        // Função para alternar o estado do endpoint
        function toggleEndpoint(element) {
            const endpoint = element.parentElement;
            endpoint.classList.toggle('active');
        }

        // Função para rolar até o endpoint
        function scrollToEndpoint(id) {
            const element = document.getElementById(id);
            element.classList.add('active');
            element.scrollIntoView({ behavior: 'smooth' });
        }
        
        // Função para carregar as contas
        async function loadAccounts() {
            try {
                const response = await fetch(`${API_BASE_URL}/accounts`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                const select = document.getElementById('accountName');
                select.innerHTML = '<option value="">Selecione uma conta</option>';
                
                if (data.status === 'success' && Array.isArray(data.data)) {
                    data.data.forEach(account => {
                        const option = document.createElement('option');
                        option.value = account.login;
                        option.textContent = account.login;
                        select.appendChild(option);
                    });
                } else {
                    console.error('Formato de resposta inválido:', data);
                }
            } catch (error) {
                console.error('Erro ao carregar contas:', error);
            }
        }

        // Carregar contas quando a página carregar
        document.addEventListener('DOMContentLoaded', loadAccounts);

        // Função para formatar JSON
        function formatJSON(json) {
            return JSON.stringify(json, null, 2);
        }

        // Função para mostrar resposta
        function showResponse(elementId, data, isError = false) {
            const responseDiv = document.getElementById(elementId);
            responseDiv.style.display = 'block';
            responseDiv.innerHTML = `<pre>${formatJSON(data)}</pre>`;
            responseDiv.style.backgroundColor = isError ? '#ffebee' : '#e8f5e9';
        }

        // Criar Conta
        document.getElementById('createAccountForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                login: document.getElementById('createLogin').value,
                password: document.getElementById('createPassword').value,
                access_level: parseInt(document.getElementById('createAccessLevel').value),
                lastServer: parseInt(document.getElementById('createLastServer').value)
            };

            try {
                const response = await fetch(`${API_BASE_URL}/accounts`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    showResponse('createResponse', result, !response.ok);
                    if (response.ok) {
                        loadAccounts(); // Recarrega a lista de contas após criar uma nova
                    }
                } else {
                    const text = await response.text();
                    showResponse('createResponse', { error: 'Resposta inválida do servidor', details: text }, true);
                }
            } catch (error) {
                showResponse('createResponse', { error: error.message }, true);
            }
        });

        // Login
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                login: document.getElementById('loginUsername').value,
                password: document.getElementById('loginPassword').value
            };

            try {
                const response = await fetch(`${API_BASE_URL}/accounts/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    showResponse('loginResponse', result, !response.ok);
                } else {
                    const text = await response.text();
                    showResponse('loginResponse', { error: 'Resposta inválida do servidor', details: text }, true);
                }
            } catch (error) {
                showResponse('loginResponse', { error: error.message }, true);
            }
        });

        // Criar Personagem
        document.getElementById('createCharacterForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                account_name: document.getElementById('accountName').value,
                char_name: document.getElementById('charName').value,
                race: parseInt(document.getElementById('race').value),
                classid: parseInt(document.getElementById('classid').value),
                sex: parseInt(document.getElementById('sex').value),
                face: parseInt(document.getElementById('face').value),
                hairStyle: parseInt(document.getElementById('hairStyle').value),
                hairColor: parseInt(document.getElementById('hairColor').value),
                x: parseInt(document.getElementById('x').value),
                y: parseInt(document.getElementById('y').value),
                z: parseInt(document.getElementById('z').value)
            };

            try {
                const response = await fetch(`${API_BASE_URL}/characters`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    showResponse('createCharacterResponse', result, !response.ok);
                } else {
                    const text = await response.text();
                    showResponse('createCharacterResponse', { error: 'Resposta inválida do servidor', details: text }, true);
                }
            } catch (error) {
                showResponse('createCharacterResponse', { error: error.message }, true);
            }
        });

        // Listar Personagens
        document.getElementById('listCharactersForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const accountName = document.getElementById('listAccountName').value;

            try {
                const response = await fetch(`${API_BASE_URL}/accounts/${accountName}/characters`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    showResponse('listCharactersResponse', result, !response.ok);
                } else {
                    const text = await response.text();
                    showResponse('listCharactersResponse', { error: 'Resposta inválida do servidor', details: text }, true);
                }
            } catch (error) {
                showResponse('listCharactersResponse', { error: error.message }, true);
            }
        });

        // Ver Detalhes do Personagem
        document.getElementById('getCharacterForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const characterId = document.getElementById('characterId').value;

            try {
                const response = await fetch(`${API_BASE_URL}/characters/${characterId}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    showResponse('getCharacterResponse', result, !response.ok);
                } else {
                    const text = await response.text();
                    showResponse('getCharacterResponse', { error: 'Resposta inválida do servidor', details: text }, true);
                }
            } catch (error) {
                showResponse('getCharacterResponse', { error: error.message }, true);
            }
        });
    </script>
</body>
</html> 