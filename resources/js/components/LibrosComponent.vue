<template>
  <div>
    <!-- Header -->
    <div class="header bg-gradient-dark pt-5 pt-md-6">
      <div class="container-fluid">
        <div class="header pb-6">
          <div class="container-fluid">
            <div class="header-body">
              <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                  <h6 class="h2 text-white d-inline-block mb-0">Libros</h6>
                  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4" >
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item">
                        <a href=""><i class="fas fa-home"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="">Inicio</a></li>
                      <li class="breadcrumb-item active" aria-current="page"> Libros </li>
                    </ol>
                  </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                  <button type="button" class="btn btn-sm btn-neutral" @click="fnNuevoLibro()" id="nuevoLibro">
                    Nuevo
                  </button>
                  <button type="button" class="btn btn-sm btn-neutral" @click="listar_libros()">
                    Recargar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header -->
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">ID</th>
                    <th scope="col" class="sort" data-sort="budget">ISBN</th>
                    <th scope="col" class="sort" data-sort="status">Año</th>
                    <th scope="col" class="sort" data-sort="status">Paginas</th>
                    <th scope="col" class="sort" data-sort="status">Nombre</th>
                    <th scope="col" class="sort" data-sort="status">Categoria</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tr v-for="libro in lista_libros" :key="libro.id">
                  <th scope="row">
                    <div class="media align-items-center">
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ libro.id }}
                          <img :src="'/storage/' + libro.url_imagen" width="120px">
                        </span>
                      </div>
                    </div>
                  </th>
                  <td class="budget">
                    {{ libro.isbn }}
                  </td>
                  <td class="budget">
                    {{ libro.anio }}
                  </td>
                  <td class="budget">
                    {{ libro.no_pagina }}
                  </td>
                  <td class="budget">
                    {{ libro.nombre }}
                  </td>
                  <td class="budget">
                    {{ libro.nombre_cat }}
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" >
                        <button class="dropdown-item" @click="fnEditarLibro(libro)">
                          <span class="btn-inner--icon"><i class="ni ni-collection"></i></span>
                          <span class="btn-inner--text">Editar</span>
                        </button>
                        <button class="dropdown-item" @click="fnMostrarModalEliminarLibro(libro)">
                          <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                          <span class="btn-inner--text">Eliminar</span>
                        </button>
                        <button class="dropdown-item" @click="fnAgregarLibro(libro)">
                          <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                          <span class="btn-inner--text">Eliminar</span>
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <!-- End Light table -->
          </div>
        </div>
      </div>
    </div>

    <!-- End Page content -->
    <!-- Modal -->
    <div
      class="modal fade" id="modalNuevoLibro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Libro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form >
              <div class="row">
                <div class="col-md-6">
                  <img :src="'/storage/' + nuevoLibro.url_imagen" width="120px">
                </div>
                <div class="col-md-6">
                    <input type="file" @change="obtenerImagen">
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>ISBN del libro</label>
                    <input type="text" class="form-control" v-model="nuevoLibro.isbn" placeholder="ISBN de Libro"/>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre del libro</label>
                    <input type="text" class="form-control" v-model="nuevoLibro.nombre" placeholder="Nombre del Libro"/>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Año del libro</label>
                    <input type="text" class="form-control" v-model="nuevoLibro.anio" placeholder="Año del Libro"/>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Numero de páginas</label>
                    <input type="text" class="form-control" v-model="nuevoLibro.no_pagina" placeholder="Numero de páginas"/>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Descripción del libro</label>
                    <input type="text" class="form-control" v-model="nuevoLibro.descripcion" placeholder="Descripción del Libro" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Precio del libro</label>
                    <input type="text" class="form-control" v-model="nuevoLibro.precio" placeholder="Precio del Libro" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" v-model="nuevoLibro.id_categoria" >
                      <option v-for="categoria in lista_categorias" :key="categoria.id" v-bind:value="categoria.id" >
                        {{ categoria.nombre }}
                      </option>
                    </select>
                  </div>
                </div>

                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Autor</label>
                    <select class="form-control" v-model="nuevoLibro.id_autor" >
                      <option v-for="autor in lista_autores" :key="autor.id" v-bind:value="autor.id" >
                        {{ autor.nombre }}
                      </option>
                    </select>
                  </div>
                </div>

                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Editorial</label>
                    <select class="form-control" v-model="nuevoLibro.id_editorial" >
                      <option v-for="editorial in lista_editoriales" :key="editorial.id" v-bind:value="editorial.id" >
                        {{ editorial.nombre }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12" v-if="errores">
                  <div class="alert alert-warning" role="alert">
                    <span class="alert-inner--icon" ><i class="ni ni-like-2"></i ></span>
                    <span class="alert-inner--text" ><strong>Warning!</strong> {{ errores }}</span>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cerrar
            </button>
            <button type="button" class="btn btn-primary" @click="guardar()">
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal eliminar-->
    <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-notification"> Your attention is required </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="py-3 text-center">
              <i class="ni ni-bell-55 ni-3x"></i>
              <h4 class="heading mt-4">Realmente desea eliminar el libro</h4>
              <p> ISBN: {{ libro_eliminar.isbn }}, Nombre: {{ libro_eliminar.nombre }} </p>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-white" @click="fnEliminarLibro(libro)">
              Eliminar
            </button>
            <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  setup() {},
  mounted() {
    this.listar_libros();
  },
  data() {
    return {
      nuevoLibro: {},
      errores: "",
      lista_libros: {},
      lista_categorias: {},
      lista_autores: {},
      lista_editoriales: {},
      libro_eliminar: {},
      url_imagen:'',
      lista_carrito:[],
    };
  },
  methods: {
    obtenerImagen(e){
      this.url_imagen =e.target.files[0]
    },
    fnNuevoLibro() {
      this.nuevoLibro = {};
      this.listar_categorias();
      this.listar_autores();
      this.listar_editoriales();
      $("#modalNuevoLibro").modal("toggle");
    },
    async listar_categorias() {
      await axios.get("api/categorias").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_categorias = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async listar_autores() {
      await axios.get("api/autores").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_autores = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async listar_editoriales() {
      await axios.get("api/editoriales").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_editoriales = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    async listar_libros() {
      await axios.get("api/libros").then((respuesta) => {
          console.log(respuesta.data);
          this.lista_libros = respuesta.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
        fnAgregarLibro(libro) {
      this.lista_carrito.push(libro);
      this.listar_categorias();
      this.listar_autores();
      this.listar_editoriales();
      $("#modalNuevoLibro").modal("toggle");
    },

    fnEditarLibro(libro) {
      this.nuevoLibro = libro;
      this.listar_categorias();
      this.listar_autores();
      this.listar_editoriales();
      $("#modalNuevoLibro").modal("toggle");
    },
    async guardar() {
      const datos_libro = new FormData;
      if(!this.nuevoLibro.id){
        datos_libro.set('id', 0); 
         datos_libro.set('isbn', this.nuevoLibro.isbn);
      datos_libro.set('anio', this.nuevoLibro.anio);
      datos_libro.set('no_pagina', this.nuevoLibro.no_pagina);
      datos_libro.set('nombre', this.nuevoLibro.nombre);
      datos_libro.set('descripcion', this.nuevoLibro.descripcion);
      datos_libro.set('url_imagen', this.url_imagen);
      datos_libro.set('precio', this.nuevoLibro.precio);
      datos_libro.set('id_categoria', this.nuevoLibro.id_categoria);
      datos_libro.set('id_autor', this.nuevoLibro.id_autor);
      datos_libro.set('id_editorial', this.nuevoLibro.id_editorial);
      }else{
        datos_libro.set('id', this.nuevoLibro.id);
         datos_libro.set('isbn', this.nuevoLibro.isbn);
      datos_libro.set('anio', this.nuevoLibro.anio);
      datos_libro.set('no_pagina', this.nuevoLibro.no_pagina);
      datos_libro.set('nombre', this.nuevoLibro.nombre);
      datos_libro.set('descripcion', this.nuevoLibro.descripcion);
      datos_libro.set('url_imagen', this.url_imagen);
      datos_libro.set('precio', this.nuevoLibro.precio);
      datos_libro.set('id_categoria', this.nuevoLibro.id_categoria);
      datos_libro.set('id_autor', this.nuevoLibro.id_autor);
      datos_libro.set('id_editorial', this.nuevoLibro.id_editorial);
      }

     

      await axios.post("api/guardar_libro", datos_libro).then((respuesta) => {
          console.log(respuesta);
          $("#modalNuevoLibro").modal("toggle");
          this.nuevoLibro = {};
          this.errores = "";
          this.listar_libros();
        })
        .catch((error) => {
          console.log(error.response.data);

          if (error.response.data.errors != null) {
            var llaves = Object.keys(error.response.data.errors)
            this.errores = error.response.data.errors[llaves[0]][0]
          } else {
            this.errores = error.message;
          }
        });
    },

    fnMostrarModalEliminarLibro(libro) {
      this.libro_eliminar = libro;
      $("#modal-eliminar").modal("toggle");
    },
    async fnEliminarLibro(libro) {
      await axios.post("api/eliminar_libro", this.libro_eliminar).then((respuesta) => {
          console.log(respuesta);
          $("#modal-eliminar").modal("toggle");
          this.libro_eliminar = {};
          this.listar_libros();
        })
        .catch((error) => {

          console.log(error.response.data);
        });
    },
  },
};
</script>