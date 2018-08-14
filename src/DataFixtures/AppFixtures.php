<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Departamento;
use App\Repository\DepartamentoRepository;
use App\Entity\Funcionario;
use App\Repository\FuncionarioRepository;
use App\Entity\Movimentacao;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $deptos = [
            ['nome' => 'Administracao', 'descr' => 'É responsável pelo planejamento estratégico e pela gestão das tarefas.'],
            ['nome' => 'Financeiro', 'descr' => 'Controla a tesouraria, os investimentos e a gestão de contas e impostos.'],
            ['nome' => 'Cormercial', 'descr' => 'É responsável pelo marketing e vendas, garantindo a geração de receitas para a empresa.'],
            ['nome' => 'Operacional', 'descr' => 'É responsável por todo o processo de transformação de insumos ou serviços no produto final.'],
            ['nome' => 'Recursos Humanos', 'descr' => 'É responsável pelo recrutamento do pessoal e pela gestão de pessoas.'],
        ];

        $dp_repos = new DepartamentoRepository();

        foreach ($deptos as $data) {
            $depto = new Departamento();
            $result = $dp_repos->findOneBy(array('nome' => $data['nome']));
            if (!$result) {

                $depto->setNome($data['nome']);
                $depto->setDescricao($data['descr']);

                $manager->persist($depto);

                if ($data['nome'] === 'Administracao') {
                    $this->addReference('dp_admin', $depto);
                }
            }
        }

        $func = new Funcionario();
        $func->setNome('Admin');
        $func->setEmail('admin@empresa.com.br');
        $func->setDepartamento($this->getReference('dp_admin'));
        $func->setSenha('1234567');

        $manager->persist($func);

        $manager->flush();
    }
}
