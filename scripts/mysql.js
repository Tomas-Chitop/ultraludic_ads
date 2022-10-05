const mysql = require('mysql');

const conection = mysql.createConnection({
    host:'localhost',
    user:'root',
    password:'',
    database:'ultraludic_ads'
})

conection.connect( (err) =>{
    if(err) throw err
    console.log('La conexion funciona')
})

//consulta
conection.query('SELECT * FROM campañas', (err, rows)=>{
    if(err) throw err
    console.log("Los datos de la tabla son estos: ")
    console.log(rows)
    console.log("La cantidad de resultados es: ")
    console.log(rows.length)
    const usuarioUno = rows[1]
    console.log('El usuario se llama '+usuarioUno.nombre_empresa+'y tiene el id: '+usuarioUno.id)
    console.log("El anuncio ha tenido: "+usuarioUno.clics+" clics")
})

const valores = window.location.search;
console.log(valores);

conection.end()