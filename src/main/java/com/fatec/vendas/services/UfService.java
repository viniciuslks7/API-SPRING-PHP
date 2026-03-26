package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Uf;
import com.fatec.vendas.repositories.UfRepository;

@Service
public class UfService extends AbstractCrudService<Uf, Integer> {
    public UfService(UfRepository repository) {
        super(repository);
    }
}
