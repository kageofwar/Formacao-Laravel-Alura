<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeSerie;
    public $qtdTemporadas;
    public $episodiosPorTemporada;
    public $idSerie;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeSerie, $qtdTemporadas, $episodiosPorTemporada, $idSerie)
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->episodiosPorTemporada = $episodiosPorTemporada;
        $this->idSerie = $idSerie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series-created')->with([
            'nomeSerie' => $this->nomeSerie,
            'qtdTemporadas' => $this->qtdTemporadas,
            'episodiosPorTemporada' => $this->episodiosPorTemporada,
            'idSerie' => $this->idSerie,
        ]);
    }
}
