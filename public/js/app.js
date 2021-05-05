var c = new Vue({
    delimiters: ['{!','!}'],
    el: '#app',
    data: {
        products: [],
        categories: [],
        order:{
            dir:1,
            column:'name'
        },

        filter:{
           name:''
        },

        product:{
           id:0,
           name:'',
           category:'',
           price:0,
           token:$("input[name='_token']").val()
        },

        currentPage:1,
        perPage:5,
        errors: {},
       
   },
   mounted(){
        this.fetchProducts(); 
        this.fetchCategories();
   },
   computed:{
      pages(){
         return Math.ceil(this.products.length/this.perPage)
      },
      isFirstPage(){
         return this.currentPage === 1;
      },
      isLastPage(){
         return this.currentPage === this.pages;
      },
      paginateProducts(){
        let start = (this.currentPage - 1) * this.perPage
        ,end = this.currentPage * this.perPage

        return this.sortProducts.slice(start, end)
      },

      sortProducts(){
         return this.filteredProducts.sort((a,b) => 
            {
               let left =  a[this.order.column],
                   right = b[this.order.column]

               if(isNaN(left) && isNaN(right)){
                  if(left>right)
                     return 1 * this.order.dir;
                  else if(left<right)
                     return -1 * this.order.dir;
                  else
                     return 0;
               }
               else
                  return (left-right) * this.order.dir;
            }
            
         ); 
           
      },
     
      sortType(){
         return this.order.dir === 1 ?'ascending':'descending'
      },

      filteredProducts(){
         let products = this.products
         if(this.filter.name.length > 0){
            let regxp = new RegExp(this.filter.name,'i')
            products =  products.filter(e =>
                e.name.match(regxp))
   
         }
         return products
      }

   },

   methods:{ 
      prev(){
         if(!this.isFirstPage){
            this.currentPage--;
         }
      },
      next(){
         if(!this.isLastPage){
            this.currentPage++;
         }
      },

      classes(col){
         //return ['sort-control','ascending'];
         return ['sort-control',
            this.order.column === col ?this.sortType:''
         ]
      },
      sort(col){
         this.order.column = col
         this.order.dir *=-1
      },
      clearText(){
         this.filter.name = ''
      },

      saveProduct(){
            axios.post($("#create_product").attr('action-target'),
                     { 
                        name: this.product.name, 
                        category_id: this.product.category, 
                        price: this.product.price,
                        _token: this.product.token
                     }).
                     then((res) => {
                       this.fetchProducts()
                       $('#exampleModalCenter').modal('hide');
                     }).catch(({response}) => {
                        this.errors = response.data.errors;
                     })
      },

      fetchProducts(){
         axios.get($("tbody").attr('data-source')).
         then((response) => {
            this.products=response.data.data
         })
      },

      fetchCategories(){
         axios.get($("#create_product").attr('data-source')).
            then((response) => {
               this.categories = response.data.data
            })
      }
   }
})
