package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Bairro;
import com.fatec.vendas.repositories.BairroRepository;

@Service
public class BairroService extends AbstractCrudService<Bairro, Integer> {
    public BairroService(BairroRepository repository) {
        super(repository);
    }
}
