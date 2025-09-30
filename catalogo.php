<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Catálogo</title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>

<body>

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="catalog-page container">
        <aside class="filters">
            <fieldset>
                <legend>Géneros</legend>
                <label><input type="checkbox" name="genre" value="action" class="checkbox"> Acción</label>
                <label><input type="checkbox" name="genre" value="adventure" class="checkbox"> Aventura</label>
                <label><input type="checkbox" name="genre" value="rpg" class="checkbox"> RPG</label>
                <label><input type="checkbox" name="genre" value="strategy" class="checkbox"> Estrategia</label>
                <label><input type="checkbox" name="genre" value="sports" class="checkbox"> Deportes</label>
                <label><input type="checkbox" name="genre" value="simulation" class="checkbox"> Simulación</label>
                <label><input type="checkbox" name="genre" value="horror" class="checkbox"> Terror</label>
                <label><input type="checkbox" name="genre" value="puzzle" class="checkbox"> Puzzle</label>
            </fieldset>
            <fieldset>
                <legend>Plataforma</legend>
                <label><input type="checkbox" name="platform" value="pc" class="checkbox"> PC</label>
                <label><input type="checkbox" name="platform" value="ps5" class="checkbox"> PS5</label>
                <label><input type="checkbox" name="platform" value="xbox" class="checkbox"> Xbox</label>
                <label><input type="checkbox" name="platform" value="switch" class="checkbox"> Switch</label>
            </fieldset>
            <div class="search-container">
                <i class="bi bi-search icon"></i>
                <input type="text" name="search" id="search" class="search" placeholder="Buscar juegos..." aria-label="Buscar juegos">                
            </div>

        </aside>

        <h1>Cátalogo de Juegos</h1>
        <p>Explora nuestra selección de juegos recomendados.</p>

        <section class="games-list">
            <div class="game">
                <picture>
                    <source srcset="dist/imgs/p5r.jpeg" type="image/jpeg">
                    <img src="dist/imgs/p5r.jpeg" alt="game image" loading="lazy">
                </picture>
                <div class="game-content">
                    <h3>Persona 5 Royal</h3>
                    <div class="tags">
                        <span class="tag">JRPG</span>
                        <span class="tag">Turn-Based</span>
                        <span class="tag">Anime</span>
                    </div>
                    <div class="rating">
                        <svg class="circle" width="100" height="100">
                            <circle class="bg" cx="50" cy="50" r="45"></circle>
                            <circle class="progress" cx="50" cy="50" r="45"></circle>
                        </svg>
                        <span class="number">85</span>
                    </div>
                    <div class="platforms">
                        <div class="platform xbox" title="Xbox">
                            <i class="bi bi-xbox"></i>
                        </div>
                        <div class="platform playstation" title="PlayStation">
                            <i class="bi bi-playstation"></i>
                        </div>
                        <div class="platform switch" title="Nintendo Switch">
                            <i class="bi bi-nintendo-switch"></i>
                        </div>
                        <div class="platform pc" title="PC">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    </div>
                    <a href="#" class="button">Ver recomendación</a>
                </div>
            </div>
            <div class="game">
                <picture>
                    <source srcset="dist/imgs/p5r.jpeg" type="image/jpeg">
                    <img src="dist/imgs/p5r.jpeg" alt="game image" loading="lazy">
                </picture>
                <div class="game-content">
                    <h3>Persona 5 Royal</h3>
                    <div class="tags">
                        <span class="tag">JRPG</span>
                        <span class="tag">Turn-Based</span>
                        <span class="tag">Anime</span>
                    </div>
                    <div class="rating">
                        <svg class="circle" width="100" height="100">
                            <circle class="bg" cx="50" cy="50" r="45"></circle>
                            <circle class="progress" cx="50" cy="50" r="45"></circle>
                        </svg>
                        <span class="number">85</span>
                    </div>
                    <div class="platforms">
                        <div class="platform xbox" title="Xbox">
                            <i class="bi bi-xbox"></i>
                        </div>
                        <div class="platform playstation" title="PlayStation">
                            <i class="bi bi-playstation"></i>
                        </div>
                        <div class="platform switch" title="Nintendo Switch">
                            <i class="bi bi-nintendo-switch"></i>
                        </div>
                        <div class="platform pc" title="PC">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    </div>
                    <a href="#" class="button">Ver recomendación</a>
                </div>
            </div>
            <div class="game">
                <picture>
                    <source srcset="dist/imgs/p5r.jpeg" type="image/jpeg">
                    <img src="dist/imgs/p5r.jpeg" alt="game image" loading="lazy">
                </picture>
                <div class="game-content">
                    <h3>Persona 5 Royal</h3>
                    <div class="tags">
                        <span class="tag">JRPG</span>
                        <span class="tag">Turn-Based</span>
                        <span class="tag">Anime</span>
                    </div>
                    <div class="rating">
                        <svg class="circle" width="100" height="100">
                            <circle class="bg" cx="50" cy="50" r="45"></circle>
                            <circle class="progress" cx="50" cy="50" r="45"></circle>
                        </svg>
                        <span class="number">85</span>
                    </div>
                    <div class="platforms">
                        <div class="platform xbox" title="Xbox">
                            <i class="bi bi-xbox"></i>
                        </div>
                        <div class="platform playstation" title="PlayStation">
                            <i class="bi bi-playstation"></i>
                        </div>
                        <div class="platform switch" title="Nintendo Switch">
                            <i class="bi bi-nintendo-switch"></i>
                        </div>
                        <div class="platform pc" title="PC">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    </div>
                    <a href="#" class="button">Ver recomendación</a>
                </div>
            </div>
            <div class="game">
                <picture>
                    <source srcset="dist/imgs/p5r.jpeg" type="image/jpeg">
                    <img src="dist/imgs/p5r.jpeg" alt="game image" loading="lazy">
                </picture>
                <div class="game-content">
                    <h3>Persona 5 Royal</h3>
                    <div class="tags">
                        <span class="tag">JRPG</span>
                        <span class="tag">Turn-Based</span>
                        <span class="tag">Anime</span>
                    </div>
                    <div class="rating">
                        <svg class="circle" width="100" height="100">
                            <circle class="bg" cx="50" cy="50" r="45"></circle>
                            <circle class="progress" cx="50" cy="50" r="45"></circle>
                        </svg>
                        <span class="number">85</span>
                    </div>
                    <div class="platforms">
                        <div class="platform xbox" title="Xbox">
                            <i class="bi bi-xbox"></i>
                        </div>
                        <div class="platform playstation" title="PlayStation">
                            <i class="bi bi-playstation"></i>
                        </div>
                        <div class="platform switch" title="Nintendo Switch">
                            <i class="bi bi-nintendo-switch"></i>
                        </div>
                        <div class="platform pc" title="PC">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    </div>
                    <a href="#" class="button">Ver recomendación</a>
                </div>
            </div>
            <div class="game">
                <picture>
                    <source srcset="dist/imgs/p5r.jpeg" type="image/jpeg">
                    <img src="dist/imgs/p5r.jpeg" alt="game image" loading="lazy">
                </picture>
                <div class="game-content">
                    <h3>Persona 5 Royal</h3>
                    <div class="tags">
                        <span class="tag">JRPG</span>
                        <span class="tag">Turn-Based</span>
                        <span class="tag">Anime</span>
                    </div>
                    <div class="rating">
                        <svg class="circle" width="100" height="100">
                            <circle class="bg" cx="50" cy="50" r="45"></circle>
                            <circle class="progress" cx="50" cy="50" r="45"></circle>
                        </svg>
                        <span class="number">85</span>
                    </div>
                    <div class="platforms">
                        <div class="platform xbox" title="Xbox">
                            <i class="bi bi-xbox"></i>
                        </div>
                        <div class="platform playstation" title="PlayStation">
                            <i class="bi bi-playstation"></i>
                        </div>
                        <div class="platform switch" title="Nintendo Switch">
                            <i class="bi bi-nintendo-switch"></i>
                        </div>
                        <div class="platform pc" title="PC">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    </div>
                    <a href="#" class="button">Ver recomendación</a>
                </div>
            </div>
        </section>

    </main>

    <?php incluirTemplate('footer'); ?>
    
</body>

</html>