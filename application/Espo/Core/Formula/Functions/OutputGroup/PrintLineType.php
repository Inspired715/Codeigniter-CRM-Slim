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

namespace Espo\Core\Formula\Functions\OutputGroup;

use Espo\Core\Formula\ArgumentList;
use Espo\Core\Formula\Functions\BaseFunction;

use stdClass;

class PrintLineType extends BaseFunction
{
    public function process(ArgumentList $args)
    {
        if (count($args) === 0) {
            $this->throwTooFewArguments(1);
        }

        $value = $this->evaluate($args[0]);

        if (is_int($value) || is_float($value)) {
            $value = strval($value);
        }
        else if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }
        else if (is_array($value)) {
            $value = json_encode($value);
        }
        else if ($value instanceof stdClass) {
            $value = json_encode($value);
        }
        else if ($value === null) {
            $value = 'null';
        }

        $variables = $this->getVariables();

        if (!isset($variables->__output)) {
            $variables->__output = '';
        }

        if ($variables->__output !== '') {
            $variables->__output = $variables->__output .= "\n";
        }

        $variables->__output = $variables->__output .= $value;
    }
}
