<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2023 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Tools\Pdf\Dompdf;

use Espo\ORM\Entity;
use Espo\Tools\Pdf\Contents;
use Espo\Tools\Pdf\Data;
use Espo\Tools\Pdf\Dompdf\Contents as DompdfContents;
use Espo\Tools\Pdf\EntityPrinter as EntityPrinterInterface;
use Espo\Tools\Pdf\Params;
use Espo\Tools\Pdf\Template;

class EntityPrinter implements EntityPrinterInterface
{
    public function __construct(
        private DompdfInitializer $dompdfInitializer,
        private HtmlComposer $htmlComposer
    ) {}

    public function print(Template $template, Entity $entity, Params $params, Data $data): Contents
    {
        $pdf = $this->dompdfInitializer->initialize($template);

        $headHtml = $this->htmlComposer->composeHead($template, $entity);
        $headerFooterHtml = $this->htmlComposer->composeHeaderFooter($template, $entity, $params, $data);
        $mainHtml = $this->htmlComposer->composeMain($template, $entity, $params, $data);

        $html = $headHtml . "\n<body>" . $headerFooterHtml . $mainHtml . "</body>";

        $pdf->loadHtml($html);
        $pdf->render();

        return new DompdfContents($pdf);
    }
}
