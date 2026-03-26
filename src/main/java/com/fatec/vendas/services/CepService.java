package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Cep;
import com.fatec.vendas.repositories.CepRepository;

@Service
public class CepService extends AbstractCrudService<Cep, Integer> {
    public CepService(CepRepository repository) {
        super(repository);
    }
}
