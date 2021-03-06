<?php
/*
 * Aca se maneja la recepcion, almacenamiento y envio de notificaciones de solicitud de acceso
 *
 * Este controlador debe recibir los parametros GET: "accion" y "disparador"
 *
 * "accion"     -> corresponde a la acción a ejecutar sobre el actuador.
 * "disparador" -> es el evento que lo ocasionó.
 *
 * */

class ArduinoReceiverAPI{
    
    public function API(){
        
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        switch($metodo){
            
            case 'GET':
                
                if(isset($_GET['accion']) && isset($_GET['disparador']))
                {
                    
                    $accion = $_GET['accion'];
                    $disparador = $_GET['disparador'];
                    
                    switch($accion){
                        
                        case BUZZER_ACTIVADO:
                            // Actualizo estado en DB
                            
                            if(Conexion::cambiarEstado(ID_BUZZER,ACTIVADO))
                            {
                                $comentario = "Se activó la alarma buzzer. Disparador: ".Conexion::disparadorLabel($disparador);
                                
                                // Enviar notificacion
                                Conexion::nuevaNotificacion($comentario);
                                LogController::info($comentario,"LOG_SERVER");
                                
                            } else {
                                // Logueo el error y mando notificacion
                                $comentarioError = "Hubo un error al activar la alarma buzzer";
                                Conexion::nuevaNotificacion($comentarioError);
                                LogController::error($comentarioError,"LOG_SERVER");
                            }
                            
                            break;
                        case BUZZER_DESACTIVADO:
                            
                            // Actualizo estado en DB
                            if(Conexion::cambiarEstado(ID_BUZZER,DESACTIVADO)){
                                $comentario = "Se desactivó la alarma buzzer. Disparador: ".Conexion::disparadorLabel($disparador);
                                
                                // Enviar notificacion
                                Conexion::nuevaNotificacion($comentario);
                                LogController::info($comentario,"LOG_SERVER");
                                
                            } else {
                                // Logueo el error y mando notificacion
                                $comentarioError = "Hubo un error al desactivar la alarma buzzer";
                                Conexion::nuevaNotificacion($comentarioError);
                                LogController::error($comentarioError,"LOG_SERVER");
                            }
                            
                            break;
                        case VENTILADOR_ACTIVADO:
                            
                            // Actualizo estado en DB
                            if(Conexion::cambiarEstado(ID_VENTILADOR,ACTIVADO)){
                                $comentario = "Se activó el ventilador. Disparador: ".Conexion::disparadorLabel($disparador);
                                
                                // Enviar notificacion
                                Conexion::nuevaNotificacion($comentario);
                                LogController::info($comentario,"LOG_SERVER");
                                
                            } else {
                                // Logueo el error y mando notificacion
                                $comentarioError = "Hubo un error al activar el ventilador";
                                Conexion::nuevaNotificacion($comentarioError);
                                LogController::error($comentarioError,"LOG_SERVER");
                            }
                            
                            break;
                        case VENTILADOR_DESACTIVADO:
                            
                            // Actualizo estado en DB
                            if(Conexion::cambiarEstado(ID_VENTILADOR,DESACTIVADO)){
                                $comentario = "Se desactivó el ventilador. Disparador: ".Conexion::disparadorLabel($disparador);
                                
                                // Enviar notificacion
                                Conexion::nuevaNotificacion($comentario);
                                LogController::info($comentario,"LOG_SERVER");
                                
                            } else {
                                // Logueo el error y mando notificacion
                                $comentarioError = "Hubo un error al desactivar el ventilador";
                                Conexion::nuevaNotificacion($comentarioError);
                                LogController::error($comentarioError,"LOG_SERVER");
                            }
                            
                            break;
                        case PUERTA_TRABADA:
                            
                            // Actualizo estado en DB
                            if(Conexion::cambiarEstado(ID_TRABA,ACTIVADO)){
                                $comentario = "Se trabó la puerta. Disparador: ".Conexion::disparadorLabel($disparador);
                                
                                // Enviar notificacion
                                Conexion::nuevaNotificacion($comentario);
                                LogController::info($comentario,"LOG_SERVER");
                                
                            } else {
                                // Logueo el error y mando notificacion
                                $comentarioError = "Hubo un error al trabar la puerta";
                                Conexion::nuevaNotificacion($comentarioError);
                                LogController::error($comentarioError,"LOG_SERVER");
                            }
                            
                            break;
                        case PUERTA_DESTRABADA:
                            
                            // Actualizo estado en DB
                            if(Conexion::cambiarEstado(ID_TRABA,DESACTIVADO)){
                                $comentario = "Se destrabó la puerta. Disparador: ".Conexion::disparadorLabel($disparador);
                                
                                // Enviar notificacion
                                Conexion::nuevaNotificacion($comentario);
                                LogController::info($comentario,"LOG_SERVER");
                                
                            } else {
                                // Logueo el error y mando notificacion
                                $comentarioError = "Hubo un error al destrabar la puerta";
                                Conexion::nuevaNotificacion($comentarioError);
                                LogController::error($comentarioError,"LOG_SERVER");
                            }
                            
                            break;
                        default:
                            // Accion no valida
                            break;
                    }
                    
                }else {
                    // 400 - solicitud incorrecta
                }
                
                break;
            case 'POST'://inserta
                echo 'POST';
                break;
            case 'PUT'://actualiza
                echo 'PUT';
                break;
            case 'DELETE'://elimina
                echo 'DELETE';
                break;
            default://metodo NO soportado
                // error 404
                echo 'METODO NO SOPORTADO';
                break;
        }
        
        
    }
}