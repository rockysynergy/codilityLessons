import java.util.ArrayList;

class CountFactors {
    ArrayList<Integer> divisors = new ArrayList<Integer>();

    public int solutionA(int N) {
        // write your code in Java SE 8

        int result = 0;
        int i = 0;
        int sqN = (int) Math.sqrt(N);
        if (Math.pow(sqN, 2) != N) sqN++;
        else result++;

        for (i = 1; i < sqN; i++) {
            if (N % i == 0) {
                result += 2;
                divisors.add(i);
                divisors.add(N/i);
            }
        }

        return result;
    }

    public ArrayList<Integer> getDivisors() {
        return divisors;
    }

    public static void main(String[] args) {
        CountFactors s = new CountFactors();
        System.out.println("The count: " + s.solutionA(23));

        ArrayList<Integer> d = s.getDivisors();
        for (int i : d) {
            System.out.println(i);
        }
    }
}