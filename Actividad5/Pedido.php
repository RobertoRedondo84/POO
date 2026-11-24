<?php

declare(strict_types=1);

class Pedido
{
    private array $lineas = [];

    public function __construct(
        private Cliente $cliente,
        private DateTimeImmutable $fecha,
        private string $estado,
        private ?Pago $pago
    ) {
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente): void
    {
        $this->cliente = $cliente;
    }

    public function getFecha(): DateTimeImmutable
    {
        return $this->fecha;
    }

    public function setFecha(DateTimeImmutable $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function getPago(): ?Pago
    {
        return $this->pago;
    }

    public function setPago(?Pago $pago): void
    {
        $this->pago = $pago;
    }

    /** @return list<LineaPedido> */
    public function getLineas(): array
    {
        return $this->lineas;
    }

    public function agregarLinea(Producto $producto, int $cantidad): void
    {
        if ($cantidad < 1) {
            throw new InvalidArgumentException('La cantidad debe ser al menos 1.');
        }
        $this->lineas[] = new LineaPedido($producto, $cantidad, $producto->getPrecio());
    }

    public function calcularTotal(): int
    {
        $total = 0;
        foreach ($this->lineas as $linea) {
            $total += $linea->calcularSubtotal();
        }
        return $total;
    }

    public function __toString(): string
    {
        return $this->fecha->format("d/m/Y") . " · $this->estado · " . euros($this->calcularTotal());
    }
}
