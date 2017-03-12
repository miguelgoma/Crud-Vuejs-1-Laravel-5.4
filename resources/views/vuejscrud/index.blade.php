@extends('master')
@section('content')
  <div class="form-group row add">
    <div class="col-md-12">
      <h1><a href="http://mikeingenia.herokuapp.com/vuejscrud">Empleados</a></h1>
    </div>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="searchEmpleado(fillItem.id)">
            <form class="form-inline mt-2 mt-md-0">
              <input class="form-control mr-sm-2" id='idbuscar' placeholder="Búscar por Id o nombre. Ejemplo: miguel" type="text">
              <button class="btn btn-info" id="search">
                  <span class="glyphicon glyphicon-search"></span> Buscar empleado
              </button>
            </form>
        </form>
      </div>
    <div class="form-group">
    </div>
    <div class="col-md-12">
      <button type="button" data-toggle="modal" data-target="#create-item" class="btn btn-success">
        Capturar nuevo empleado
      </button>      
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
      <table class="table table-borderless">
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Fecha de nacimiento</th>
          <th>Salario Anual</th>
        </tr>
        <tr v-for="item in items">
          <td>@{{ item.id }}</td>
          <td>@{{ item.name }}</td>
          <td>@{{ item.firstname }}</td>
          <td>@{{ item.lastname }}</td>
          <td>@{{ item.date_of_birth }}</td>
          <td>$ @{{ item.salary }}</td>
          <td>
            <button class="edit-modal btn btn-success" @click.prevent="editItem(item)">
              <span class="glyphicon glyphicon-edit"></span> Editar
            </button>
            <button class="edit-modal btn btn-danger" @click.prevent="deleteItem(item)">
              <span class="glyphicon glyphicon-trash"></span> Borrar
            </button>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <nav>
    <ul class="pagination">
      <li v-if="pagination.current_page > 1">
        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
          <span aria-hidden="true">«</span>
        </a>
      </li>
      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
        <a href="#" @click.prevent="changePage(page)">
          @{{ page }}
        </a>
      </li>
      <li v-if="pagination.current_page < pagination.last_page">
        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </nav>
  <!--Reports-->
  <!-- Modal -->
  <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Capturar nuevo empleado</h4>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem">
            <div class="form-group">
              <label for="title">Nombre:</label>
              <input type="text" name="name" class="form-control" v-model="newItem.name" />
              <span v-if="formErrors['name']" class="error text-danger">
                @{{ formErrors['title'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="title">Apellido Paterno:</label>
              <input type="text" name="firstname" class="form-control" v-model="newItem.firstname" />
              <span v-if="formErrors['firstname']" class="error text-danger">
                @{{ formErrors['firstname'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="title">Apellido Materno:</label>
              <input type="text" name="lastname" class="form-control" v-model="newItem.lastname" />
              <span v-if="formErrors['lastname']" class="error text-danger">
                @{{ formErrors['lastname'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="title">Fecha de nacimiento:</label>
              <input type="text" name="date_of_birth" class="form-control" v-model="newItem.date_of_birth" />
              <span v-if="formErrors['date_of_birth']" class="error text-danger">
                @{{ formErrors['date_of_birth'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="title">Salario Anual:</label>
              <input type="text" name="salary" class="form-control" v-model="newItem.salary" />
              <span v-if="formErrors['salary']" class="error text-danger">
                @{{ formErrors['salary'] }}
              </span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Edit Modal Window-->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar empleado</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
          <div class="form-group">
            <label for="title">Nombre:</label>
            <input type="text" name="name" class="form-control" v-model="fillItem.name" />
            <span v-if="formErrorsUpdate['name']" class="error text-danger">
              @{{ formErrorsUpdate['name'] }}
            </span>
          </div>
          <div class="form-group">
            <label for="title">Apellido Paterno:</label>
            <input type="text" name="firstname" class="form-control" v-model="fillItem.firstname" />
            <span v-if="formErrorsUpdate['firstname']" class="error text-danger">
              @{{ formErrorsUpdate['firstname'] }}
            </span>
          </div>
          <div class="form-group">
            <label for="title">Apellido Materno:</label>
            <input type="text" name="lastname" class="form-control" v-model="fillItem.lastname" />
            <span v-if="formErrorsUpdate['lastname']" class="error text-danger">
              @{{ formErrorsUpdate['lastname'] }}
            </span>
          </div>
          <div class="form-group">
            <label for="title">Fecha de nacimiento:</label>
            <input type="text" name="date_of_birth" class="form-control" v-model="fillItem.date_of_birth" />
            <span v-if="formErrorsUpdate['date_of_birth']" class="error text-danger">
              @{{ formErrorsUpdate['date_of_birth'] }}
            </span>
          </div>
          <div class="form-group">
            <label for="title">Salario Anual:</label>
            <input type="text" name="salary" class="form-control" v-model="fillItem.salary" />
            <span v-if="formErrorsUpdate['salary']" class="error text-danger">
              @{{ formErrorsUpdate['salary'] }}
            </span>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
