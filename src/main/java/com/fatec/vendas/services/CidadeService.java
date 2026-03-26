package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Cidade;
import com.fatec.vendas.repositories.CidadeRepository;

@Service
public class CidadeService extends AbstractCrudService<Cidade, Integer> {
    public CidadeService(CidadeRepository repository) {
        super(repository);
    }
}
