<?php
namespace Model\Dto;

trait Hydrator {
    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = $this->getMethodName($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    private function getMethodName($name) {
        $parts = explode('_', $name);
        for ($i = 0, $c = count($parts) ; $i < $c ; $i++) {
            $parts[$i] = ucfirst($parts[$i]);
        }
        $name = implode('', $parts);
        $name = 'set' . $name;
        return $name;
    }
}