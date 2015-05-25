while [ true ]
do
	echo 'run Frequency'
    java -jar frequencyInterventionNet.jar
    echo 'run Slot'
    java -jar slotInterventionNet.jar
    echo 'run Sequence'
    java -jar selectSequenceNet.jar
    echo 'run Goal'
    java -jar selectGoalNet.jar
    echo 'run Behaviour'
    java -jar selectBehaviourNet.jar
    sleep 86400
done