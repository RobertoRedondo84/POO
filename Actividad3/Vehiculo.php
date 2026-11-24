<?php

declare(strict_types=1);

class Vehiculo
{
    public function __construct(
        protected string $marca,
        protected string $modelo,
        protected int $cilindrada,
        protected string $matricula
    ) {
    }

    public function __get(string $propiedad): mixed
    {
        return match ($propiedad) {
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'cilindrada' => $this->cilindrada,
            'matricula' => $this->matricula,
            default => throw new InvalidArgumentException("Propiedad desconocida: $propiedad"),
        };
    }

    public function __set(string $propiedad, mixed $valor): void
    {
        match ($propiedad) {
            'marca' => $this->marca = $valor,
            'modelo' => $this->modelo = $valor,
            'cilindrada' => $this->cilindrada = $valor,
            'matricula' => $this->matricula = $valor,
            default => throw new InvalidArgumentException("Propiedad desconocida: $propiedad"),
        };
    }

    public function __toString(): string
    {
        return "$this->marca $this->modelo · $this->cilindrada cc · Matrícula $this->matricula";
    }
}

class Moto extends Vehiculo
{
    public function __construct(
        string $marca,
        string $modelo,
        int $cilindrada,
        string $matricula,
        private int $plazas,
        private bool $sidecar
    ) {
        parent::__construct($marca, $modelo, $cilindrada, $matricula);
    }

    public function __get(string $propiedad): mixed
    {
        return match ($propiedad) {
            'plazas' => $this->plazas,
            'sidecar' => $this->sidecar,
            default => parent::__get($propiedad),
        };
    }

    public function __set(string $propiedad, mixed $valor): void
    {
        match ($propiedad) {
            'plazas' => $this->plazas = $valor,
            'sidecar' => $this->sidecar = $valor,
            default => parent::__set($propiedad, $valor),
        };
    }

    public function __toString(): string
    {
        $sidecar = $this->sidecar ? 'sí' : 'no';

        return 'Moto · ' . parent::__toString() . " · $this->plazas plazas · Sidecar: $sidecar";
    }

    public function frenarDelantero(): string
    {
        return "La moto $this->modelo acciona el freno delantero.";
    }

    public function frenarTrasero(): string
    {
        return "La moto $this->modelo acciona el freno trasero.";
    }
}

class Coche extends Vehiculo
{
    public function __construct(
        string $marca,
        string $modelo,
        int $cilindrada,
        string $matricula,
        private int $plazas,
        private bool $descapotable
    ) {
        parent::__construct($marca, $modelo, $cilindrada, $matricula);
    }

    public function __get(string $propiedad): mixed
    {
        return match ($propiedad) {
            'plazas' => $this->plazas,
            'descapotable' => $this->descapotable,
            default => parent::__get($propiedad),
        };
    }

    public function __set(string $propiedad, mixed $valor): void
    {
        match ($propiedad) {
            'plazas' => $this->plazas = $valor,
            'descapotable' => $this->descapotable = $valor,
            default => parent::__set($propiedad, $valor),
        };
    }

    public function __toString(): string
    {
        $descapotable = $this->descapotable ? 'sí' : 'no';

        return 'Coche · ' . parent::__toString()
            . " · $this->plazas plazas · Descapotable: $descapotable";
    }

    public function quitarCapota(): string
    {
        if ($this->descapotable) {
            return "Se retira la capota del $this->modelo.";
        }

        return "El $this->modelo tiene techo fijo.";
    }
}

class Camion extends Vehiculo
{
    public function __construct(
        string $marca,
        string $modelo,
        int $cilindrada,
        string $matricula,
        private int $tara,
        private int $carga,
        private int $ejes
    ) {
        parent::__construct($marca, $modelo, $cilindrada, $matricula);
    }

    public function __get(string $propiedad): mixed
    {
        return match ($propiedad) {
            'tara' => $this->tara,
            'carga' => $this->carga,
            'ejes' => $this->ejes,
            default => parent::__get($propiedad),
        };
    }

    public function __set(string $propiedad, mixed $valor): void
    {
        match ($propiedad) {
            'tara' => $this->tara = $valor,
            'carga' => $this->carga = $valor,
            'ejes' => $this->ejes = $valor,
            default => parent::__set($propiedad, $valor),
        };
    }

    public function __toString(): string
    {
        return 'Camión · ' . parent::__toString()
            . " · Tara: $this->tara kg · Carga: $this->carga kg · Ejes: $this->ejes";
    }
}