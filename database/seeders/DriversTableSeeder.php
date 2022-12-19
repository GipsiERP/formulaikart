<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sql = "
        INSERT INTO drivers
        (id, name, apelido, cpf, rg, dn, telefone, celular, email, nickname_math, status, created_at, updated_at, deleted_at)
        values
            (1, 'BILLY PERDIGÃO', 'BILLY PERDIGÃO', NULL, NULL, NULL, NULL, '', 'verificar@email.com.br', 'BILLY PERDIGÃO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (2, 'FABIO DANTAS', 'FABIO DANTAS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FABIO DANTAS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (3, 'R. OTERO', 'R. OTERO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'R. OTERO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (4, 'LUCAS LIMA', 'LUCAS LIMA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LUCAS LIMA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (5, 'FERNANDO BONOTTI', 'FERNANDO BONOTTI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FERNANDO BONOTTI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (6, 'R. LOPES', 'R. LOPES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'R. LOPES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (7, 'P. MIRANDA', 'P. MIRANDA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'P. MIRANDA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (8, 'REGINALDO CRUZ JR', 'REGINALDO JR', '26451227870', '23047723-9', '1979-07-08', '1135913687', '11994400465', 'rjunior.cruz@gmail.com', 'REGINALDO JR|', 1, '2022-04-14 00:00:00.000', '2022-04-16 13:19:15.000', NULL),
            (9, 'ERICH', 'ERICH', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ERICH|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (10, 'MOTTA', 'MOTTA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MOTTA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (11, 'PACHECO', 'PACHECO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'PACHECO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (12, 'JAPA', 'JAPA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'JAPA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (13, 'HANASHIRO', 'HANASHIRO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'HANASHIRO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (14, 'ADRIANO', 'ADRIANO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ADRIANO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (15, 'RONALDO', 'RONALDO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'RONALDO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (16, 'JR FOGAÇA', 'JR FOGAÇA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'JR FOGAÇA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (17, 'MARCELO', 'MARCELO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MARCELO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (18, 'RAFAEL FERNANDES', 'RAFAEL FERNANDES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'RAFAEL FERNANDES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (19, 'R. TEIXEIRA', 'R. TEIXEIRA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'R. TEIXEIRA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (20, 'DYO', 'DYO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'DYO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (21, 'SANTANDER', 'SANTANDER', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'SANTANDER|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (22, 'PANNUNZIO', 'PANNUNZIO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'PANNUNZIO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (23, 'ARRUDA', 'ARRUDA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ARRUDA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (24, 'FERRERI', 'FERRERI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FERRERI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (25, 'D. MORAES', 'D. MORAES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'D. MORAES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (26, 'R. BARROS', 'R. BARROS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'R. BARROS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (27, 'PEDRO SANTANDER', 'PEDRO SANTANDER', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'PEDRO SANTANDER|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (28, 'JAM SOUZA', 'JAM SOUZA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'JAM SOUZA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (29, 'FERNANDO', 'FERNANDO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FERNANDO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (30, 'V. GUTIERREZ', 'V. GUTIERREZ', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'V. GUTIERREZ|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (31, 'VECCHI', 'VECCHI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'VECCHI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (32, 'PRETO', 'PRETO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'PRETO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (33, 'ARAUJO', 'ARAUJO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ARAUJO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (34, 'R. VOGES', 'R. VOGES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'R. VOGES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (35, 'OSIANDER', 'OSIANDER', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'OSIANDER|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (36, 'JOHNNY', 'JOHNNY', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'JOHNNY|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (37, 'ALISSON RICARTE', 'ALISSON RICARTE', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ALISSON RICARTE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (38, 'ELEANE', 'ELEANE', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ELEANE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (39, 'TALITINHA', 'TALITINHA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'TALITINHA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (40, 'NATHY MOTTA', 'NATHY MOTTA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'NATHY MOTTA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (41, 'SU HANASHIRO', 'SU HANASHIRO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'SU HANASHIRO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (42, 'LILIANE TORRES', 'LILIANE TORRES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LILIANE TORRES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (43, 'VI HANASHIRO', 'VI HANASHIRO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'VI HANASHIRO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (44, 'RÔ PACHECO', 'RÔ PACHECO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'RÔ PACHECO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (45, 'YASMIN LIANEZA', 'YASMIN LIANEZA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'YASMIN LIANEZA|YASMIN LLANEZA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (46, 'NICK', 'NICK', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'NICK|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (47, 'NAIMA', 'NAIMA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'NAIMA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (48, 'MI', 'MI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (49, 'VIVI', 'VIVI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'VIVI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (50, 'BIA', 'BIA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'BIA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (51, 'DE SOUSA', 'DE SOUSA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'DE SOUSA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (52, 'VITINHO', 'VITINHO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'VITINHO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (53, 'SAMIR', 'SAMIR', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'SAMIR|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (54, 'F. TOZELLI', 'F. TOZELLI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'F. TOZELLI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (55, 'LEO', 'LEO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LEO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (56, 'E. BOLCHI', 'E. BOLCHI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'E. BOLCHI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (57, 'BARBOZA', 'BARBOZA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'BARBOZA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (58, 'DIEGO FERREIRA', 'DIEGO FERREIRA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'DIEGO FERREIRA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (59, 'FILIPE', 'FILIPE', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FILIPE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (60, 'MURILO ANDRADE', 'MURILO ANDRADE', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MURILO ANDRADE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (61, 'WELL', 'WELL', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'WELL|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (62, 'WILL', 'WILL', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'WILL|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (63, 'VERMELHO', 'VERMELHO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'VERMELHO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (64, 'ALKMIM', 'ALKMIM', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ALKMIM|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (65, 'LORENZO', 'LORENZO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LORENZO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (66, 'BLACK DIAMOND', 'BLACK DIAMOND', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'BLACK DIAMOND|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (67, 'L. MAGALHÃES', 'L. MAGALHÃES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'L. MAGALHÃES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (68, 'SID GASQUES', 'SID GASQUES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'SID GASQUES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (69, 'ESQUERDA', 'ESQUERDA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ESQUERDA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (70, 'IVAN', 'IVAN', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'IVAN|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (71, 'MANASSES', 'MANASSES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MANASSES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (72, 'ANDERSON', 'ANDERSON', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ANDERSON|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (73, 'KAIQUE SILVEIRA', 'KAIQUE SILVEIRA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'KAIQUE SILVEIRA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (74, 'CACÁ', 'CACÁ', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'CACÁ|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (75, 'THIAGO TRABUCO', 'THIAGO TRABUCO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'THIAGO TRABUCO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (76, 'TIAO CARREIRO', 'TIAO CARREIRO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'TIAO CARREIRO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (77, 'GUINA', 'GUINA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'GUINA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (78, 'M. H. RAMOS', 'M. H. RAMOS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'M. H. RAMOS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (79, 'NUNES', 'NUNES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'NUNES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (80, 'GIAN', 'GIAN', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'GIAN|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (81, 'RODRIGO', 'RODRIGO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'RODRIGO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (82, 'ELIEL', 'ELIEL', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ELIEL|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (83, 'MAIRENE', 'MAIRENE', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MAIRENE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (84, 'RIOS', 'RIOS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'RIOS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (85, 'WILLIAM', 'WILLIAM', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'WILLIAM|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (86, 'M. JUNIOR', 'M. JUNIOR', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'M. JUNIOR|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (87, 'JAPA P2 BIKES', 'JAPA P2 BIKES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'JAPA P2 BIKES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (88, 'YASMIN LLANEZA', 'YASMIN LLANEZA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'YASMIN LLANEZA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', '2022-04-01 00:00:00.000'),
            (89, 'SHIELA RODRIGUES', 'SHIELA RODRIGUES', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'SHIELA RODRIGUES|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (90, 'V. GALVAO', 'V. GALVAO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'V. GALVAO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (91, 'A. CARDOSO', 'A. CARDOSO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'A. CARDOSO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (92, 'FELIPE', 'FELIPE', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FELIPE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (93, 'LOBATO', 'LOBATO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LOBATO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (94, 'F. NEIVA', 'F. NEIVA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'F. NEIVA|F. VEIVA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (95, 'FERNANDO SILVA', 'FERNANDO SILVA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'FERNANDO SILVA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (96, 'NAL SANTOS', 'NAL SANTOS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'NAL SANTOS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (97, 'TATI', 'TATI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'TATI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (98, 'V. RAGASSI', 'V. RAGASSI', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'V. RAGASSI|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (99, 'LÊ', 'LÊ', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LE|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (100, 'CAROLINE TOLEDO', 'CAROLINE TOLEDO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'CAROLINE TOLEDO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (101, 'ADRIANA TOLEDO', 'ADRIANA TOLEDO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ADRIANA TOLEDO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (102, 'MARCOS RAMOS', 'MARCOS RAMOS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MARCOS|RAMOS', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (103, 'NEGO', 'NEGO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'NEGO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (104, 'ISAIAS', 'ISAIAS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ISAIAS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (105, 'BARREIROS', 'BARREIROS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'BARREIROS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (106, 'H. FREITAS', 'H. FREITAS', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'H. FREITAS|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (107, 'ALAN CARVALHO', 'ALAN CARVALHO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'ALAN CARVALHO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (109, 'CHUCKY', 'CHUCKY', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'CHUCKY|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (110, 'MALDONADO', 'MALDONADO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'MALDONADO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (111, 'F. PANNUNZIO', 'F. PANNUNZIO', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'F. PANNUNZIO|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL),
            (112, 'LEANDRO COSTA', 'LEANDRO COSTA', NULL, NULL, NULL, NULL, NULL, 'verificar@email.com.br', 'LEANDRO COSTA|', 1, '2022-04-14 00:00:00.000', '2022-04-14 00:00:00.000', NULL)
            ;                
        ";
                
        \DB::Insert($sql);
    }
}
