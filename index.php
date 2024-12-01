<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Catálogo de Películas">
    <title>Servicios en la Nube - Catálogo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            position: relative;
            min-height: 100vh;
            background: linear-gradient(
                rgba(0, 0, 0, 0.7),
                rgba(0, 0, 0, 0.7)
            ), url('https://www.sdpnoticias.com/resizer/v2/W2VKYAM2HVNNBNDIHQEOEG6LZU.jpg?smart=true&auth=4484a626b3893cb073f08f99068337aef9f8d84886b81b1ca2c7379b26dff346&width=640&height=360') center/cover no-repeat fixed;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        header {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            height: 60px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        main {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .movies-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 20px 0;
        }

        .movie-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .movie-card:hover {
            transform: translateY(-5px);
        }

        .movie-cover {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .movie-info {
            padding: 15px;
        }

        .movie-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .movie-year {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .movie-synopsis {
            color: #444;
            font-size: 0.9rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        footer {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        footer p {
            margin: 8px 0;
            color: #333;
        }

        a {
            color: #0066cc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #004499;
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .movies-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            header {
                padding: 15px;
            }

            .logo {
                height: 45px;
            }

            main {
                padding: 20px;
            }

            .movies-grid {
                grid-template-columns: 1fr;
            }
        }

        .add-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .movie-form {
            display: grid;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .movie-actions {
            padding: 15px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            background: #f5f5f5;
            border-top: 1px solid #ddd;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #2196F3;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .modal-confirm {
            max-width: 400px;
            text-align: center;
        }

        .modal-confirm .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel {
            background-color: #9e9e9e;
            color: white;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .alert-error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        .search-bar {
            width: 100%;
            max-width: 400px;
            padding: 10px 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .search-bar:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(74, 175, 80, 0.2);
        }

        .movie-card.hidden {
            display: none;
        }

        .trailer-container {
            position: relative;
            padding-bottom: 56.25%; /* Ratio 16:9 */
            height: 0;
            overflow: hidden;
            margin-top: 15px;
            border-radius: 8px;
        }

        .trailer-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .trailer-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .movie-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            overflow: hidden;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .movie-info {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .movie-synopsis {
            color: #444;
            font-size: 0.9rem;
            margin-bottom: 15px;
            /* Quitamos las propiedades de truncamiento para mostrar todo el texto */
            display: block;
            -webkit-line-clamp: unset;
            -webkit-box-orient: unset;
            overflow: visible;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-54rddyjZmKI9gjYbZ-bqVZr_gGzeyujaAg&s" alt="Logo del sitio" class="logo">
        </header>

        <main>
            <?php
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success">Operación realizada con éxito</div>';
            }
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-error">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>

            <button class="add-button" onclick="openModal('movieModal')">Agregar Nueva Película</button>

            <!-- Modal para agregar película -->
            <div id="movieModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('movieModal')">&times;</span>
                    <h2>Agregar Nueva Película</h2>
                    <form class="movie-form" action="add_movie.php" method="POST">
                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="year">Año:</label>
                            <input type="number" id="year" name="year" required min="1900" max="2024">
                        </div>
                        <div class="form-group">
                            <label for="synopsis">Sinopsis:</label>
                            <textarea id="synopsis" name="synopsis" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cover">URL de la Portada:</label>
                            <input type="url" id="cover" name="cover" required>
                        </div>
                        <div class="form-group">
                            <label for="trailer">URL del Trailer (YouTube):</label>
                            <input type="url" id="trailer" name="trailer" 
                                placeholder="https://www.youtube.com/watch?v=... o https://youtu.be/..." 
                                onchange="this.value = convertToEmbedUrl(this.value)" required>
                        </div>
                        <button type="submit" class="submit-btn">Agregar Película</button>
                    </form>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <input type="text" id="searchInput" class="search-bar" placeholder="Buscar películas..." onkeyup="filterMovies()">
            </div>

            <!-- Modal para editar película -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('editModal')">&times;</span>
                    <h2>Editar Película</h2>
                    <form class="movie-form" action="edit_movie.php" method="POST">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-title">Título:</label>
                            <input type="text" id="edit-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-year">Año:</label>
                            <input type="number" id="edit-year" name="year" required min="1900" max="2024">
                        </div>
                        <div class="form-group">
                            <label for="edit-synopsis">Sinopsis:</label>
                            <textarea id="edit-synopsis" name="synopsis" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-cover">URL de la Portada:</label>
                            <input type="url" id="edit-cover" name="cover" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-trailer">URL del Trailer (YouTube):</label>
                            <input type="url" id="edit-trailer" name="trailer" 
                                placeholder="https://www.youtube.com/watch?v=... o https://youtu.be/..." 
                                onchange="this.value = convertToEmbedUrl(this.value)" required>
                        </div>
                        <button type="submit" class="submit-btn">Guardar Cambios</button>
                    </form>
                </div>
            </div>

            <!-- Modal de confirmación para eliminar -->
            <div id="deleteModal" class="modal">
                <div class="modal-content modal-confirm">
                    <span class="close" onclick="closeModal('deleteModal')">&times;</span>
                    <h2>Confirmar Eliminación</h2>
                    <p>¿Estás seguro de que deseas eliminar esta película?</p>
                    <div class="actions">
                        <button class="btn btn-cancel" onclick="closeModal('deleteModal')">Cancelar</button>
                        <form action="delete_movie.php" method="POST" style="display: inline;">
                            <input type="hidden" id="delete-id" name="id">
                            <button type="submit" class="btn btn-delete">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="movies-grid">
                <?php
                $host = 'mysql-techwork-udgvirtual-techwork.e.aivencloud.com';
                $db   = 'movies';
                $user = 'avnadmin';
                $pass = 'AVNS_1Dye_sfp1FZnU6d4yOr';
                $port = '18118';

                try {
                    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $stmt = $pdo->query('SELECT * FROM movies ORDER BY year DESC');
                    while ($movie = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="movie-card">';
                        echo '<img src="' . htmlspecialchars($movie['cover']) . '" alt="' . htmlspecialchars($movie['title']) . '" class="movie-cover">';
                        echo '<div class="movie-info">';
                        echo '<h2 class="movie-title">' . htmlspecialchars($movie['title']) . '</h2>';
                        echo '<div class="movie-year">Año: ' . htmlspecialchars($movie['year']) . '</div>';
                        echo '<p class="movie-synopsis">' . htmlspecialchars($movie['synopsis']) . '</p>';
                        if (!empty($movie['trailer'])) {
                            echo '<div class="trailer-section">';
                            echo '<div class="trailer-container">';
                            echo '<iframe src="' . htmlspecialchars($movie['trailer']) . '" 
                                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                          allowfullscreen></iframe>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '<div class="movie-actions">';

                        $movieData = [
                            'id' => $movie['id'],
                            'title' => $movie['title'],
                            'year' => $movie['year'],
                            'synopsis' => $movie['synopsis'],
                            'cover' => $movie['cover'],
                            'trailer' => $movie['trailer']
                        ];
                        echo '<button class="btn btn-edit" onclick="editMovie(' . htmlspecialchars(json_encode($movie)) . ')">Editar</button>';
                        echo '<button class="btn btn-delete" onclick="confirmDelete(' . $movie['id'] . ')">Eliminar</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } catch(PDOException $e) {
                    echo '<p>Error de conexión: ' . $e->getMessage() . '</p>';
                }
                ?>
            </div>
        </main>

        <footer>
            <p><strong>Curso:</strong> Conceptualización de servicios en la nube</p>
            <p><strong>Alumno:</strong> Angel Francisco Sánchez De Tagle Márquez</p>
            <p><strong>Contacto:</strong> <a href="mailto:angel.sanchezdetagle@udgvirtual.udg.mx">angel.sanchezdetagle@udgvirtual.udg.mx</a></p>
        </footer>
    </div>

    <script>
        // Funciones de Modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            if(modalId === 'movieModal') {
                document.getElementById('addMovieForm').reset();
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Funciones de Película
        function editMovie(movie) {
            document.getElementById('edit-id').value = movie.id;
            document.getElementById('edit-title').value = movie.title;
            document.getElementById('edit-year').value = movie.year;
            document.getElementById('edit-synopsis').value = movie.synopsis;
            document.getElementById('edit-cover').value = movie.cover;
            document.getElementById('edit-trailer').value = movie.trailer ? convertToEmbedUrl(movie.trailer) : '';
            
            openModal('editModal');
        }

        function confirmDelete(movieId) {
            document.getElementById('delete-id').value = movieId;
            openModal('deleteModal');
        }

        // Función de Búsqueda
        function filterMovies() {
            const searchInput = document.getElementById('searchInput');
            const filter = searchInput.value.toLowerCase();
            const movieCards = document.getElementsByClassName('movie-card');

            for (let card of movieCards) {
                const title = card.querySelector('.movie-title').textContent.toLowerCase();
                const year = card.querySelector('.movie-year').textContent.toLowerCase();
                const synopsis = card.querySelector('.movie-synopsis').textContent.toLowerCase();
                
                if (title.includes(filter) || 
                    year.includes(filter) || 
                    synopsis.includes(filter)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }

        // Funciones de URL de YouTube
        function convertToEmbedUrl(url) {
            if (url.includes('embed')) {
                return url;
            }
            
            let videoId = '';
            
            if (url.includes('youtu.be')) {
                videoId = url.split('youtu.be/')[1];
            } 
            else if (url.includes('youtube.com/watch')) {
                videoId = new URL(url).searchParams.get('v');
            }
            
            videoId = videoId.split('?')[0];
            videoId = videoId.split('&')[0];
            
            return `https://www.youtube.com/embed/${videoId}`;
        }

        // Funciones de Validación y Envío
        async function submitMovie(event) {
            event.preventDefault();
            
            if (!validateForm()) {
                return false;
            }

            const form = document.getElementById('addMovieForm');
            const formData = new FormData(form);

            try {
                const response = await fetch('/add_movie.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        closeModal('movieModal');
                        form.reset();
                        setTimeout(() => {
                            window.location.href = window.location.pathname + '?success=1';
                        }, 500);
                    } else {
                        throw new Error(result.error || 'Error al agregar la película');
                    }
                } else {
                    throw new Error('Error en la respuesta del servidor');
                }
            } catch (error) {
                alert('Error: ' + error.message);
            }

            return false;
        }

        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const year = document.getElementById('year').value;
            const synopsis = document.getElementById('synopsis').value.trim();
            const cover = document.getElementById('cover').value.trim();
            const trailer = document.getElementById('trailer').value.trim();

            if (!title || !year || !synopsis || !cover || !trailer) {
                alert('Por favor, complete todos los campos requeridos');
                return false;
            }

            const currentYear = new Date().getFullYear();
            if (year < 1900 || year > currentYear) {
                alert('Por favor, ingrese un año válido (entre 1900 y ' + currentYear + ')');
                return false;
            }

            return true;
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración de placeholders para inputs de trailer
            const trailerInputs = document.querySelectorAll('input[name="trailer"]');
            const placeholder = "Ejemplo: https://www.youtube.com/watch?v=xxx o https://youtu.be/xxx";
            trailerInputs.forEach(input => {
                input.placeholder = placeholder;
            });
        });

        // Cerrar modales al hacer clic fuera de ellos
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>