# Correcciones realizadas
## Explicativo de paso a paso de como resolvi los bugfix
Antes de empezar, no podia montar el database.php entonces cree otro en base a uno con que trabaje anteriormente, le agregue mensajes y gracias a eso logramos generar el archivo idesa.db
### Desafio #1
 * Modificamos la funcion getLotes(int $clientID) para que pueda tomar el clientID y devolver los datos del lote de ese cliente. Esto es debido que la funcion solo llama todos los registros para llevarlo a la siguiente y hacer una comparacion que no permitia devolver los lotes a cobrar del cliente
 * Modificamos la funcion  getClientDebt(int $clientID) para que esta procese la funcion getLotes con el clientID enviado y luego dentro del forEach comparar las fechas de vencimiento con la actual. En caso que la fecha de vencimiento sea menor a la fecha actual entonces se imprimira los lotes a cobrar, si pasa lo contrario se pasara a un json donde indica que no hay lotes que cobrar


### Desafio #2
 * Modificamos la funcion getLotes(string $loteID): array ya que esta solo admitia int al valor lote y este es de tipo text en la tabla debts. Se modifico la funcion para que tome los datos del numero de lote y envie como array
 * Modificamos la funcion  retrieveLotes, primeramente en el nombre ya que decia retriveLotes y se pasa a llamar retrieve. Luego guardamos el array proveido por la funcion getLotes en una variable y se convierte a un json imprimiendo en un echo

### Desafio #3
* Abrir una terminal en la ubicacion del proyecto, ejecutar php -S localhost:8000 y luego con metodo GET consultar al rest con el enlace http://localhost:8000/resultado.php?lote_id=1 (dependera de como tiene configurado el localhost y puerto para levantar el REST)


LINKEDIN: https://www.linkedin.com/in/ariel-shultz-benitez/
# Gracias por su atencion
