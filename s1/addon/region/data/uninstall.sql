DELETE FROM hook WHERE `name` = 'RegionSelect';

DELETE FROM addon WHERE `name` = 'Region';

DROP TABLE IF EXISTS `region`;