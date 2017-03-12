Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-vue',
  data :{
    items: [],
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    newItem : {'name':'','firstname':'','lastname':'','date_of_birth':'','salary':''},
    fillItem : {'name':'','firstname':'','lastname':'','date_of_birth':'','salary':'','id':''}
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  ready: function() {
    this.getVueItems(this.pagination.current_page);
  },
  methods: {
    getVueItems: function(page) {
      this.$http.get('/vueitems?page='+page).then((response) => {
        this.$set('items', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createItem: function() {
      var input = this.newItem;
      this.$http.post('/vueitems',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newItem = {'name':'','firstname':'','lastname':'','date_of_birth':'','salary':''};
        $("#create-item").modal('hide');
        toastr.success('Se ha creado un nuevo registro.', 'Mensaje:', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deleteItem: function(item) {
      this.$http.delete('/vueitems/'+item.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('Se ha borrado exitosamente.', 'Mensaje:', {timeOut: 5000});
      });
    },
    editItem: function(item) {
      this.fillItem.name = item.name;
      this.fillItem.id = item.id;
      this.fillItem.firstname = item.firstname;
      this.fillItem.lastname = item.lastname;
      //var res = item.date_of_birth.split("-"); 
      //var db = res[2]+'-'+res[1]+'-'+res[0];
      //this.fillItem.date_of_birth = db;
      this.fillItem.date_of_birth = item.date_of_birth;
      this.fillItem.salary = item.salary;
      $("#edit-item").modal('show');
    },
    updateItem: function(id) {
      var input = this.fillItem;      
      this.$http.put('/vueitems/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        $("#edit-item").modal('hide');
        toastr.success('Actualización exitosa.', 'Mensaje:', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVueItems(page);
    },
    searchEmpleado: function(item) {
      var item = $( "#idbuscar" ).val();
      var myRegEx  = /^([a-zA-Z0-9 _-]+)$/;
      var isValid = !(myRegEx.test(item));
      $( "#idbuscar" ).val("");
      if (isValid) {
        toastr.error('Caracteres no permitidos', 'Error!', {timeOut: 5000});
      }else{
          this.fillItem.name = item.name;
          this.fillItem.id = item.id;
          this.fillItem.firstname = item.firstname;
          this.fillItem.lastname = item.lastname;
          this.fillItem.date_of_birth = item.date_of_birth;
          this.fillItem.salary = item.salary;
          $("#edit-item").modal('show');
      }
      
    },
  }
});