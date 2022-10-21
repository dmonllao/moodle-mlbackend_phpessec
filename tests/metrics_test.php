<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Test metrics.
 *
 * @package    mlbackend_phpessec
 * @copyright  2022 David Monllao <david.monllao@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

class testable_processor extends \mlbackend_phpessec\processor {

    public function get_avg_accuracy_metrics(array $precisions, array $recalls, array $truepositives, array $falsepositives,
        array $falsenegatives, array $supports): array {
        return parent::get_avg_accuracy_metrics($precisions, $recalls, $truepositives, $falsepositives, $falsenegatives, $supports);
    }

}

/**
 * Test metrics.
 *
 * @package    mlbackend_phpessec
 * @copyright  2022 David Monllao <david.monllao@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mlbackend_phpessec_metrics_testcase extends advanced_testcase {

    public function test_metrics() {

        $testable = new testable_processor();

        $extrainfo = $testable->get_avg_accuracy_metrics(
            [0.5],
            [0.5],
            [2],
            [2],
            [2],
            [2],
        );
        $this->assertEquals('Precision 0.5', $extrainfo[0]);
        $this->assertEquals('Recall 0.5', $extrainfo[1]);
        $this->assertEquals('Precisions for all the evaluated models [0.5]', $extrainfo[2]);
        $this->assertEquals('Recalls for all the evaluated models [0.5]', $extrainfo[3]);
        $this->assertEquals('Confusion matrix for evaluated model #1 {"truepositives":2,"falsepositives":2,"falsenegatives":2,"truenegatives":2}', $extrainfo[4]);


        $extrainfo = $testable->get_avg_accuracy_metrics(
            [0.5, 0.5, 0.5],
            [0.5, 0.5, 0.5],
            [2, 2, 2],
            [2, 2, 2],
            [2, 2, 2],
            [2, 2, 2],
        );
        $this->assertEquals('Precision 0.5', $extrainfo[0]);
        $this->assertEquals('Recall 0.5', $extrainfo[1]);
        $this->assertEquals('Precisions for all the evaluated models [0.5,0.5,0.5]', $extrainfo[2]);
        $this->assertEquals('Recalls for all the evaluated models [0.5,0.5,0.5]', $extrainfo[3]);
        $this->assertEquals('Confusion matrix for evaluated model #1 {"truepositives":2,"falsepositives":2,"falsenegatives":2,"truenegatives":2}', $extrainfo[4]);
        $this->assertEquals('Confusion matrix for evaluated model #2 {"truepositives":2,"falsepositives":2,"falsenegatives":2,"truenegatives":2}', $extrainfo[5]);
        $this->assertEquals('Confusion matrix for evaluated model #3 {"truepositives":2,"falsepositives":2,"falsenegatives":2,"truenegatives":2}', $extrainfo[6]);
    }
}
