array function roll
    CALL selected to check for update to score
    CALL bonus to score

    CALL trueRoll to trueRollArray

    IF true is in trueRollArray THEN
        roll dices that are true
    
    GET all dices and add to data array

    GET sum of all dices and add to session 

    ADD one too rollCounter
    SET total summa to data array

    return data

function selected
    GET selection number
    GET sum of all dices with selected number

    IF selected number is one THEN
        SET number to session select1
    IF selected number is two THEN
        SET number to session select2
    ...
    IF selected number is six THEN
        SET number to session select6

    IF selected number exsists THEN
        SET rollCounter back to 0
        SET session able to roll again
        ADD number of all dices too total summa

function bonus
    IF total summa equals 63 THEN
        SET bonus to 50