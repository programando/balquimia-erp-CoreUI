
import Vue       from 'vue';
import Router    from 'vue-router';
Vue.use(Router);
Vue.config.devtools = true;


export default new Router({
   routes : [
        { component : require('./views/maestros/Dashboard'),
          name      : 'inicio',
          path      : '/'     },

        { component : require('./views/maestros/Cargos'),
          name      : 'cargos',
          path      : '/cargos'     },

        { component : require('./views/maestros/UndsMedida') ,
          name      : 'medidas',
          path      : '/medidas'     },

/*
        { component : require('./components/maestros/Lineas')  ,
          name      : 'lineas',
          path      : '/lineas'     },

        { path      : '*' ,
          component : require('./components/errors/404')
        }*/

      ],
   linkExactActiveClass: 'active',
   //linkActiveClass:   'active',
   //mode:              'history',
   scrollBehavior(){
      return { x:0, y:0 };
   }
});
