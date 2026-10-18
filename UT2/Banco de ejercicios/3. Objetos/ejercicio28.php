<?php
    // array asociativo
    $libro = [
        'titulo' => 'dune',
        'autor' => 'Francisco',
        'paginas' => 67,
        'disponible' => true
        ];

    // Clase libro
    class Libro {

        // Constructor
        public function __construct(
            public ?string $titulo,
            public string $autor,
            public int $paginas > 1,
            public bool $disponible = true
        ) {}

        // Métodos
        // Ejercicio 29
        public function prestar(): void {
            $this->$disponible = false;
        }
        public function devolver(): void{
            $this->$disponible = true;
        }
        public function estaDisponible(): bool {
            return $this.$disponible;
        }

    }

    $objetoLibro = new Libro(
        $libro['titulo'],
        $libro['autor'],
        $libro['paginas'],
        $libro['genero']
    );

    // Ejercicio 30
    //      CODIGO JAVA 
    // public class LibroJava {
    //     public static String titulo;
    //     public static String autor;
        
    //     public LiboJava(String titulo, String autor){
    //         this.titulo = titulo;
    //         this.autor = autor;
    //     }

    //     public String getTitulo(){
    //         return titulo;
    //     }
    // }


    // Ejercicio 31
    class Autor {
        public function __construct(
            public string $autor
        ){}
    }

    class Categoria {
        public function __construct(
            public string $categoria
        ){}
    }

    // Ejercicio 32
    class 

?>