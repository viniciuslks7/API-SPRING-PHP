package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Compra;
import com.fatec.vendas.repositories.CompraRepository;

@Service
public class CompraService extends AbstractCrudService<Compra, Integer> {
    public CompraService(CompraRepository repository) {
        super(repository);
    }
}
