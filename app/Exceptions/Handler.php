<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException; // Importa la excepción de TokenMismatch
use Illuminate\Support\Facades\Auth; // Importa el facade de Auth
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Una lista de los tipos de excepciones que no deben ser reportadas.
     *
     * @var array<int, class-string>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Una lista de los tipos de excepciones que no deben ser convertidas a respuestas HTTP.
     *
     * @var array<int, class-string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Registra las devoluciones de llamada de manejo de excepciones para la aplicación.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Renderiza una excepción en una respuesta HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
{
    if ($e instanceof TokenMismatchException) {
        return redirect()
            ->route('session.expired'); // Redirige a una ruta específica
    }

    return parent::render($request, $e);
}
}
