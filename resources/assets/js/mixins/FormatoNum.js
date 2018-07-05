module.exports = {
    methods:{
              Msj(){
                  alert('estoy desde mixnin');
              },

              Puntos(input)  {
                var num = input.value.replace(/\./g,'');
                if(!isNaN(num)){
                  num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                  num = num.split('').reverse().join('').replace(/^[\.]/,'');
                  input.value = num;
                }

                else{
                  alert('Solo se permiten numeros');
                  input.value = input.value.replace(/[^\d\.]*/g,'');
              }
            } ,

           roundFormat: function (value, decimals) {
                return Number(Math.round(value+'e'+decimals)+'e-'+decimals).toFixed(decimals);
            },
            currencyFormat: function (value, decimals, symbol='') {
                return symbol + this.roundFormat(value,2);
            }

        }
}

