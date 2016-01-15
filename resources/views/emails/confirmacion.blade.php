<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Bienvenido a que partido</title>
  <style type="text/css">
    body,td,th {
     font-family: Verdana, Geneva, sans-serif;
     font-size: 14px;
     font-weight:lighter;
     color: #666;
   }
   h1{
     font-family:Arial, Helvetica, sans-serif;
     font-size: 30px;
     font-weight: bold;
     color: #0B2239;
     text-transform: uppercase;
   }
 </style>
</head>
<body>
  <table width="600" border="0" align="left" cellpadding="0" cellspacing="5">
    <tr>
      <td height="163" colspan="3"><a href="www.quepartido.com"><img src="http://quepartido.com/images/header-mail.png" width="600" height="186" longdesc="http://quepartido.com" /></a></td>
    </tr>
    <tr>
      <td height="91" valign="middle"><h1>&nbsp;</h1>
      </td>
      <td height="91" align="center" valign="middle"><h1>Gracias por registrarte!<br />
      </h1></td>
      <td height="91" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td width="36" height="100" valign="top">&nbsp;</td>
      <td height="91" valign="middle">Gracias por registrarte en nuestra comunidad ahora solo falta un paso para poder utilizar nuestra app.
        Por favor haz click en el boton entrar para confirmar tu registro.

        <br />

        <a style="display: block;text-align: center;" href="{{ 'http://quepartido.com/registro/verificacion/'. $user->confirmation_code }}" ><img src="http://quepartido.com/images/boton_entrar.png" width="295" height="63" alt="entrar" /></a>
      </td>
      <td width="31" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="36" height="185" valign="top">&nbsp;</td>
      <td width="523" align="left" valign="top"><p>Recuerda:<br /></p>
        Quepartido.com es una comunidad de apasionados por el f&uacute;tbol basada en unas simples reglas respetadas por todos. Este es un espacio para la diversi&oacute;n y el deporte, para ser parte de este tenemos que ser serios, fiables y respetuosos.
        <p>PARA COMENZAR:<br />
        Tu correo ser&aacute; tu herramienta principal, tenlo siempre presente pues a trav&eacute;s de este te llegaran mensajes, reservas, partidos, resultados y toda clase de notificaciones del portal. A la hora de reservar tu celular registrado es muy importante, este ser&aacute; el medio por el que las canchas confirmen las reservas. Si no logran comunicarse contigo es posible que ellas las cancelen.</p>
        <p>Ahora entra a Quepartido.com y disfruta el ser parte de la comunidad.</p>
      </td>
      <td width="31" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td width="36" height="185" valign="top">&nbsp;</td>
        <td height="42"  valign="top">Si tiene problemas para entrar copie y pegue este link en el navegador {{ 'http://quepartido.com/registro/verificacion/'. $user->confirmation_code }}.</td>
        <td width="31" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" colspan="3"><img src="http://quepartido.com/images/footer-mail.png" alt="footer" width="599" height="41" usemap="#Map" border="0" /></td>
      </tr>
    </table>

    <map name="Map" id="Map">
      <area shape="rect" coords="512,9,532,33" href="#" />
      <area shape="rect" coords="537,11,559,32" href="#" />
      <area shape="rect" coords="564,11,585,31" href="#" />
    </map>
  </body>
  </html>
